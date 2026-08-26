<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = collect([
            ['loc' => route('home'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('about'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('projects.index'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('blog.index'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('contact.index'), 'lastmod' => now()->toAtomString()],
        ]);

        $urls = $urls
            ->concat(Project::query()->published()->get()->map(fn (Project $project) => [
                'loc' => route('projects.show', $project->slug),
                'lastmod' => $project->updated_at->toAtomString(),
            ]))
            ->concat(Post::query()->published()->get()->map(fn (Post $post) => [
                'loc' => route('blog.show', $post->slug),
                'lastmod' => $post->updated_at->toAtomString(),
            ]));

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}
