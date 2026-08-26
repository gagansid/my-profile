<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query()->published()->with(['category', 'technologies', 'tags']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $request->string('tag')));
        }

        $projects = $query->orderBy('order')->paginate(9)->withQueryString();
        $categories = Category::query()->type('project')->active()->orderBy('name')->get();
        $tags = Tag::query()->where('is_active', true)->orderBy('name')->get();

        return view('projects.index', compact('projects', 'categories', 'tags'));
    }

    public function show(string $slug)
    {
        $project = Project::query()
            ->published()
            ->with(['category', 'technologies', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
