<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::current();

        return view('admin.site-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::current();

        $data = $request->validate([
            'maintenance_message' => ['nullable', 'string'],
        ]);

        foreach (['is_site_public', 'show_about', 'show_projects', 'show_blog', 'show_contact'] as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        $setting->update($data);

        return back()->with('status', 'site-settings-updated');
    }
}
