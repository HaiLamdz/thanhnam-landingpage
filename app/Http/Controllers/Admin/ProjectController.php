<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
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
        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['image_path'] = $this->imageService->store($request->file('image'), 'projects');
        unset($data['image']);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được tạo thành công.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->imageService->delete($project->image_path);
            $data['image_path'] = $this->imageService->store($request->file('image'), 'projects');
        }

        unset($data['image']);

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được cập nhật thành công.');
    }

    public function destroy(Project $project)
    {
        $this->imageService->delete($project->image_path);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được xóa thành công.');
    }
}
