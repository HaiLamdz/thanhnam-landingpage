<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;

class ProjectsController extends Controller
{
    public function index()
    {
        $serviceId = request('service');

        $projects = Project::published()
            ->when($serviceId, function ($query) use ($serviceId) {
                return $query->whereHas('services', function ($q) use ($serviceId) {
                    $q->where('services.id', $serviceId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $services = Service::published()->ordered()->get();

        return view('public.projects', compact('projects', 'services'));
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
