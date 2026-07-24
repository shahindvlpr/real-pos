<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::withCount('products')->latest()->paginate(10);
        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:units,name',
            'code' => 'required|string|max:20|unique:units,code',
            'description' => 'nullable|string|max:500',
            'status' => 'boolean'
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        Unit::create($validated);

        return redirect()->route('units.index')->with('success', 'Unit created successfully!');
    }

    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'code' => 'required|string|max:20|unique:units,code,' . $unit->id,
            'description' => 'nullable|string|max:500',
            'status' => 'boolean'
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        $unit->update($validated);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->products()->count() > 0) {
            return back()->with('error', 'Cannot delete unit with products!');
        }

        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}