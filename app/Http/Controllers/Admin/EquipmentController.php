<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipmentRequest;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $q = request('q');
        $status = request('status');

        $equipments = Equipment::when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
                               ->when($status, fn($query) => $query->where('status', $status))
                               ->orderBy('sort_order')
                               ->orderBy('id')
                               ->paginate(15)
                               ->withQueryString();

        return view('admin.equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(StoreEquipmentRequest $request)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Equipment::create($data);

        return redirect()->route('admin.equipments.index')->with('success', 'Thiết bị đã được tạo thành công.');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipments.edit', compact('equipment'));
    }

    public function update(StoreEquipmentRequest $request, Equipment $equipment)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? $equipment->sort_order;

        $equipment->update($data);

        return redirect()->route('admin.equipments.index')->with('success', 'Thiết bị đã được cập nhật thành công.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('admin.equipments.index')->with('success', 'Thiết bị đã được xóa thành công.');
    }
}
