<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\ProfileInfo;
use App\Models\Skill;

class AboutController extends Controller
{
    public function index()
    {
        $profile = ProfileInfo::query()->first();
        $experiences = Experience::query()->orderBy('order')->get();
        $educations = Education::query()->orderBy('order')->get();
        $skills = Skill::query()->orderBy('order')->get()->groupBy('category');

        return view('about.index', compact('profile', 'experiences', 'educations', 'skills'));
    }
}
