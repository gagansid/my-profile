<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::query()->orderBy('name')->paginate(15);

        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        Technology::create($data);

        return redirect()->route('admin.technologies.index')->with('status', 'technology-created');
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $technology->update($data);

        return redirect()->route('admin.technologies.index')->with('status', 'technology-updated');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('status', 'technology-deleted');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
        ]);
    }
}
