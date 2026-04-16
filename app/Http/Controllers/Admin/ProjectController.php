<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Service;
use App\Services\ImageService;

class ProjectController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $q        = request('q');
        $status   = request('status');

        $projects = Project::when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
                           ->when($status, fn($query) => $query->where('status', $status))
                           ->orderBy('created_at', 'desc')
                           ->paginate(15)
                           ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $services = Service::published()->ordered()->get();
        return view('admin.projects.create', compact('services'));
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $services = $data['services'] ?? [];
        unset($data['services']);

        $data['image_path'] = $this->imageService->store($request->file('image'), 'projects');
        unset($data['image']);

        $project = Project::create($data);
        $project->services()->attach($services);

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được tạo thành công.');
    }

    public function edit(Project $project)
    {
        $project->load('services');
        $services = Service::published()->ordered()->get();
        return view('admin.projects.edit', compact('project', 'services'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $services = $data['services'] ?? [];
        unset($data['services']);

        if ($request->hasFile('image')) {
            $this->imageService->delete($project->image_path);
            $data['image_path'] = $this->imageService->store($request->file('image'), 'projects');
        }

        unset($data['image']);

        $project->update($data);
        $project->services()->sync($services);

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được cập nhật thành công.');
    }

    public function destroy(Project $project)
    {
        $this->imageService->delete($project->image_path);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được xóa thành công.');
    }
}
