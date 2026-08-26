<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProfileInfo;
use App\Models\Project;
use App\Models\SocialLink;

class HomeController extends Controller
{
    public function index()
    {
        $profile = ProfileInfo::query()->first();
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('order')->get();
        $projects = Project::query()->published()->with('category')->orderBy('order')->limit(3)->get();
        $posts = Post::query()->published()->with('category')->latest('published_at')->limit(3)->get();

        return view('home.index', compact('profile', 'socialLinks', 'projects', 'posts'));
    }
}
