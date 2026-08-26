<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()->with('category')->orderBy('order')->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create', [
            'categories' => Category::query()->type('project')->active()->orderBy('name')->get(),
            'technologies' => Technology::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project = Project::create($data);
        $project->technologies()->sync($request->input('technologies', []));
        $project->tags()->sync($this->resolveTags($request->input('tags')));

        return redirect()->route('admin.projects.index')->with('status', 'project-created');
    }

    public function edit(Project $project)
    {
        $project->load('technologies', 'tags');

        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => Category::query()->type('project')->active()->orderBy('name')->get(),
            'technologies' => Technology::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);

        if ($data['title'] !== $project->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $project);
        }

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail_path) {
                Storage::disk('public')->delete($project->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);
        $project->technologies()->sync($request->input('technologies', []));
        $project->tags()->sync($this->resolveTags($request->input('tags')));

        return redirect()->route('admin.projects.index')->with('status', 'project-updated');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail_path) {
            Storage::disk('public')->delete($project->thumbnail_path);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'project-deleted');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'demo_url' => ['nullable', 'url'],
            'repo_url' => ['nullable', 'url'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['exists:technologies,id'],
            'tags' => ['nullable', 'string'],
        ]);
    }

    private function uniqueSlug(string $title, ?Project $ignore = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (Project::query()->where('slug', $slug)->when($ignore, fn($q) => $q->whereKeyNot($ignore->id))->exists()) {
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
