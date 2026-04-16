<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityImageRequest;
use App\Models\ActivityImage;
use App\Services\ImageService;

class ActivityImageController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $q = request('q');
        $status = request('status');

        $activityImages = ActivityImage::when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
                                      ->when($status, fn($query) => $query->where('status', $status))
                                      ->orderBy('sort_order')
                                      ->orderBy('id')
                                      ->paginate(15)
                                      ->withQueryString();

        return view('admin.activity-images.index', compact('activityImages'));
    }

    public function create()
    {
        return view('admin.activity-images.create');
    }

    public function store(StoreActivityImageRequest $request)
    {
        $data = $request->validated();
        $data['image_path'] = $this->imageService->store($request->file('image'), 'activity-images');
        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        ActivityImage::create($data);

        return redirect()->route('admin.activity-images.index')->with('success', 'Hình ảnh hoạt động đã được tạo thành công.');
    }

    public function edit(ActivityImage $activityImage)
    {
        return view('admin.activity-images.edit', compact('activityImage'));
    }

    public function update(StoreActivityImageRequest $request, ActivityImage $activityImage)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->imageService->delete($activityImage->image_path);
            $data['image_path'] = $this->imageService->store($request->file('image'), 'activity-images');
        }

        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? $activityImage->sort_order;

        $activityImage->update($data);

        return redirect()->route('admin.activity-images.index')->with('success', 'Hình ảnh hoạt động đã được cập nhật thành công.');
    }

    public function destroy(ActivityImage $activityImage)
    {
        $this->imageService->delete($activityImage->image_path);
        $activityImage->delete();

        return redirect()->route('admin.activity-images.index')->with('success', 'Hình ảnh hoạt động đã được xóa thành công.');
    }
}
