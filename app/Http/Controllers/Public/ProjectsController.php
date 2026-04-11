<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::published()->orderBy('created_at', 'desc')->get();

        return view('public.projects', compact('projects'));
    }

    public function show(Project $project)
    {
        abort_if($project->status !== 'published', 404);

        $related = Project::published()
            ->where('id', '!=', $project->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('public.project-show', compact('project', 'related'));
    }
}
