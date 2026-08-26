<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->published()->with(['category', 'tags']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $request->string('tag')));
        }

        $posts = $query->latest('published_at')->paginate(6)->withQueryString();
        $categories = Category::query()->type('post')->active()->orderBy('name')->get();
        $tags = Tag::query()->where('is_active', true)->orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);
        $contentHtml = $converter->convert($post->content ?? '')->getContent();

        return view('blog.show', compact('post', 'contentHtml'));
    }
}
