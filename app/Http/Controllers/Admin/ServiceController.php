<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use App\Services\ImageService;
use App\Services\SlugService;

class ServiceController extends Controller
{
    protected SlugService $slugService;
    protected ImageService $imageService;

    public function __construct(SlugService $slugService, ImageService $imageService)
    {
        $this->slugService  = $slugService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $q      = request('q');
        $status = request('status');

        $services = Service::when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
                           ->when($status, fn($query) => $query->where('status', $status))
                           ->orderBy('sort_order')
                           ->orderBy('id')
                           ->paginate(15)
                           ->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->slugService->generate($data['title'], Service::class);

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->imageService->store($request->file('image'), 'services');
        }

        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được tạo thành công.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(StoreServiceRequest $request, Service $service)
    {
        $data = $request->validated();

        if ($data['title'] !== $service->title) {
            $data['slug'] = $this->slugService->generate($data['title'], Service::class, $service->id);
        }

        if ($request->hasFile('image')) {
            $this->imageService->delete($service->image_path);
            $data['image_path'] = $this->imageService->store($request->file('image'), 'services');
        }

        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? $service->sort_order;

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được cập nhật thành công.');
    }

    public function destroy(Service $service)
    {
        $this->imageService->delete($service->image_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được xóa thành công.');
    }
}
