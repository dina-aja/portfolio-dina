<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;

class CvController extends Controller
{
    public function index()
    {
        return view('cv', [
            'settings' => Setting::values(),
            'skills' => Skill::orderBy('category')->orderByDesc('percentage')->get(),
            'experiences' => Experience::all(),
            'certificates' => Certificate::latest()->get(),
            'projects' => Project::latest()->take(4)->get(),
        ]);
    }
}
