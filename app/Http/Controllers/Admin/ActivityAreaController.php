<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityAreaRequest;
use App\Models\ActivityArea;

class ActivityAreaController extends Controller
{
    public function index()
    {
        $q = request('q');
        $status = request('status');

        $activityAreas = ActivityArea::when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
                                     ->when($status, fn($query) => $query->where('status', $status))
                                     ->orderBy('sort_order')
                                     ->orderBy('id')
                                     ->paginate(15)
                                     ->withQueryString();

        return view('admin.activity-areas.index', compact('activityAreas'));
    }

    public function create()
    {
        return view('admin.activity-areas.create');
    }

    public function store(StoreActivityAreaRequest $request)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        ActivityArea::create($data);

        return redirect()->route('admin.activity-areas.index')->with('success', 'Lĩnh vực hoạt động đã được tạo thành công.');
    }

    public function edit(ActivityArea $activityArea)
    {
        return view('admin.activity-areas.edit', compact('activityArea'));
    }

    public function update(StoreActivityAreaRequest $request, ActivityArea $activityArea)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? $activityArea->sort_order;

        $activityArea->update($data);

        return redirect()->route('admin.activity-areas.index')->with('success', 'Lĩnh vực hoạt động đã được cập nhật thành công.');
    }

    public function destroy(ActivityArea $activityArea)
    {
        $activityArea->delete();

        return redirect()->route('admin.activity-areas.index')->with('success', 'Lĩnh vực hoạt động đã được xóa thành công.');
    }
}
