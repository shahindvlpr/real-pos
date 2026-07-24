<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo'] = 'uploads/brands/' . $logoName;
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->has('status') ? true : false;

        Brand::create($validated);

        return redirect()->route('brands.index')->with('success', 'Brand created successfully!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('logo')) {
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo'] = 'uploads/brands/' . $logoName;
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->has('status') ? true : false;

        $brand->update($validated);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products()->count() > 0) {
            return back()->with('error', 'Cannot delete brand with products!');
        }

        if ($brand->logo && file_exists(public_path($brand->logo))) {
            unlink(public_path($brand->logo));
        }

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully!');
    }
}