<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use App\Models\Project;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::published()->ordered()->limit(3)->get();
        $projects = Project::published()->orderBy('created_at', 'desc')->get();
        $posts    = NewsPost::published()->orderedByDate()->limit(3)->get();

        return view('public.home', compact('services', 'projects', 'posts'));
    }
}
