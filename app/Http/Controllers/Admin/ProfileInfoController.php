<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileInfo;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileInfoController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService)
    {
    }

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
            'avatar' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:'.config('media.max_upload_size')],
            'cv' => ['nullable', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar_path'] = $this->imageUploadService->store(
                $request->file('avatar'),
                'avatars',
                $profile->avatar_path,
            );
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
