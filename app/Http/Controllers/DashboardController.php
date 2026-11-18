<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'projectCount' => Project::count(),
            'messageCount' => Message::where('is_read', false)->count(),
            'sections' => config('portfolio.crud'),
            'settings' => Setting::values(),
        ]);
    }
}
