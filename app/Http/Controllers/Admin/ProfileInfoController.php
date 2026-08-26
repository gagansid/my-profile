<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileInfoController extends Controller
{
    public function edit()
    {
        $profile = ProfileInfo::query()->firstOrCreate(['id' => 1]);

        return view('admin.profile-info.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = ProfileInfo::query()->firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'years_experience' => ['required', 'integer', 'min:0'],
            'completed_projects' => ['required', 'integer', 'min:0'],
            'satisfied_customers' => ['required', 'integer', 'min:0'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'cv' => ['nullable', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($profile->cv_path) {
                Storage::disk('public')->delete($profile->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('cv', 'public');
        }

        unset($data['avatar'], $data['cv']);

        $profile->update($data);

        return back()->with('status', 'profile-info-updated');
    }
}
