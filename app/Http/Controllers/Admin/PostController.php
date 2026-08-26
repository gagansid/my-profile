<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->with('category')->latest('id')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::query()->type('post')->active()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('posts', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = Post::create($data);
        $post->tags()->sync($this->resolveTags($request->input('tags')));

        return redirect()->route('admin.posts.index')->with('status', 'post-created');
    }

    public function edit(Post $post)
    {
        $post->load('tags');

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::query()->type('post')->active()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request);

        if ($data['title'] !== $post->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $post);
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail_path) {
                Storage::disk('public')->delete($post->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail')->store('posts', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post->update($data);
        $post->tags()->sync($this->resolveTags($request->input('tags')));

        return redirect()->route('admin.posts.index')->with('status', 'post-updated');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail_path) {
            Storage::disk('public')->delete($post->thumbnail_path);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'post-deleted');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'string'],
        ]);
    }

    private function uniqueSlug(string $title, ?Post $ignore = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (Post::query()->where('slug', $slug)->when($ignore, fn($q) => $q->whereKeyNot($ignore->id))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function resolveTags(?string $tags): array
    {
        if (! $tags) {
            return [];
        }

        return collect(explode(',', $tags))
            ->map(fn($name) => trim($name))
            ->filter()
            ->map(function ($name) {
                return Tag::query()->firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name, 'is_active' => true]
                )->id;
            })
            ->all();
    }
}
