<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'settings' => Setting::values(),
            'projects' => Project::latest()->get(),
            'certificates' => Certificate::latest()->get(),
            'experiences' => Experience::all(),
            'skills' => Skill::orderBy('category')->orderByDesc('percentage')->get(),
            'testimonials' => Testimonial::latest()->get(),
            'blogPosts' => BlogPost::whereNotNull('published_at')
                ->latest('published_at')
                ->get(),
        ]);
    }
}
