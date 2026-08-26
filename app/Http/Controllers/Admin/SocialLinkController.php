<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::query()->orderBy('order')->paginate(15);

        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        SocialLink::create($data);

        return redirect()->route('admin.social-links.index')->with('status', 'social-link-created');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $socialLink->update($data);

        return redirect()->route('admin.social-links.index')->with('status', 'social-link-updated');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')->with('status', 'social-link-deleted');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'platform' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
            'icon' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);
    }
}
