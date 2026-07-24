@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')
@section('page-subtitle', 'Update product information')

@push('styles')
<style>
    .form-wrapper {margin: 0 auto; width: 100%; }
    .form-card { background: #FFFFFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #FEF3C7; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #F59E0B; }
    .form-header-title { font-size: 15px; font-weight: 700; color: #0F172A; }
    .form-header-subtitle { font-size: 11px; color: #94A3B8; font-weight: 500; margin-top: 1px; }
    .form-body { padding: 28px; }
    .form-section { margin-bottom: 24px; }
    .form-section:last-child { margin-bottom: 0; }
    .section-title { font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 1px solid #F1F5F9; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
    .full { grid-column: 1 / -1; }
    .form-group { display: flex; flex-direction: column; gap: 4px; }
    .form-label { font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-label .req { color: #EF4444; }
    .form-input, .form-select, .form-textarea { padding: 9px 12px; border: 1px solid #E2E8F0; font-size: 13px; color: #0F172A; font-family: 'Inter', sans-serif; width: 100%; background: #FFF; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,0.08); }
    .form-textarea { resize: vertical; min-height: 70px; }
    .form-hint { font-size: 10px; color: #94A3B8; }
    .file-upload { border: 2px dashed #E2E8F0; padding: 30px; text-align: center; cursor: pointer; background: #FAFBFC; }
    .file-upload:hover { border-color: #3B82F6; background: #EFF6FF; }
    .current-img { display: flex; align-items: center; gap: 12px; padding: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; margin-bottom: 12px; }
    .current-img img { width: 56px; height: 56px; object-fit: cover; border: 1px solid #E2E8F0; }
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-update { padding: 10px 24px; background: #F59E0B; border: 1px solid #F59E0B; color: #FFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    .btn-cancel:hover { background: #F1F5F9; }
    .btn-update:hover { background: #D97706; }
    @media (max-width: 768px) { .grid-2, .grid-3 { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
            <div><div class="form-header-title">Edit: {{ $product->name }}</div><div class="form-header-subtitle">SKU: {{ $product->sku }}</div></div>
        </div>

        @if($errors->any())
            <div style="padding:0 28px;margin-top:20px;"><div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px 16px;color:#DC2626;font-size:12px;"><ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-body">
                <!-- Basic Info -->
                <div class="form-section">
                    <div class="section-title">Basic Information</div>
                    <div class="grid-2">
                        <div class="form-group full"><label class="form-label">Product Name <span class="req">*</span></label><input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input" required></div>
                        <div class="form-group"><label class="form-label">SKU</label><input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-input"></div>
                        <div class="form-group"><label class="form-label">Barcode</label><input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}" class="form-input"></div>
                        <div class="form-group full"><label class="form-label">Description</label><textarea name="description" class="form-textarea">{{ old('description', $product->description) }}</textarea></div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="form-section">
                    <div class="section-title">Pricing</div>
                    <div class="grid-3">
                        <div class="form-group"><label class="form-label">Cost Price <span class="req">*</span></label><input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="form-input" step="0.01" required></div>
                        <div class="form-group"><label class="form-label">Selling Price <span class="req">*</span></label><input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="form-input" step="0.01" required></div>
                        <div class="form-group"><label class="form-label">Wholesale Price</label><input type="number" name="wholesale_price" value="{{ old('wholesale_price', $product->wholesale_price) }}" class="form-input" step="0.01"></div>
                        <div class="form-group"><label class="form-label">Tax (%)</label><input type="number" name="tax_percentage" value="{{ old('tax_percentage', $product->tax_percentage) }}" class="form-input" min="0" max="100"></div>
                    </div>
                </div>

                <!-- Relations -->
                <div class="form-section">
                    <div class="section-title">Category & Brand</div>
                    <div class="grid-3">
                        <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-select"><option value="">None</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
                        <div class="form-group"><label class="form-label">Brand</label><select name="brand_id" class="form-select"><option value="">None</option>@foreach($brands as $brand)<option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>@endforeach</select></div>
                        <div class="form-group"><label class="form-label">Unit</label><select name="unit_id" class="form-select"><option value="">None</option>@foreach($units as $unit)<option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }} ({{ $unit->code }})</option>@endforeach</select></div>
                    </div>
                </div>

                <!-- Stock -->
                <div class="form-section">
                    <div class="section-title">Stock</div>
                    <div class="grid-3">
                        <div class="form-group"><label class="form-label">Quantity <span class="req">*</span></label><input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="form-input" required></div>
                        <div class="form-group"><label class="form-label">Min Stock Alert</label><input type="number" name="min_stock_quantity" value="{{ old('min_stock_quantity', $product->min_stock_quantity) }}" class="form-input"></div>
                    </div>
                </div>

                <!-- Image -->
                <div class="form-section">
                    <div class="section-title">Product Image</div>
                    @if($product->image)
                        <div class="current-img">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            <span style="font-size:11px;color:#64748B;">Current image. Upload new to replace.</span>
                        </div>
                    @endif
                    <div class="file-upload" onclick="document.getElementById('imgInput').click()">
                        <div style="font-size:13px;font-weight:600;color:#475569;">Click to upload new image</div>
                        <div style="font-size:10px;color:#94A3B8;margin-top:4px;">Leave empty to keep current</div>
                    </div>
                    <input type="file" id="imgInput" name="image" accept="image/*" style="display:none;">
                </div>

                <!-- Active -->
                <div class="form-section" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:13px;font-weight:600;color:#334155;">Active</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-update">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection