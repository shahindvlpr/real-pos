@extends('layouts.admin')

@section('title', 'Create Product')
@section('page-title', 'New Product')
@section('page-subtitle', 'Add a new product to inventory')

@push('styles')
<style>
    .form-wrapper {margin: 0 auto; width: 100%; }
    .form-card { background: #FFFFFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #3B82F6; }
    .form-header-title { font-size: 15px; font-weight: 700; color: #0F172A; }
    .form-header-subtitle { font-size: 11px; color: #94A3B8; font-weight: 500; margin-top: 1px; }
    .form-body { padding: 28px; }
    .form-section { margin-bottom: 24px; }
    .form-section:last-child { margin-bottom: 0; }
    .section-title { font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 1px solid #F1F5F9; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
    .grid-4 { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; }
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
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-save { padding: 10px 24px; background: #3B82F6; border: 1px solid #3B82F6; color: #FFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    .btn-cancel:hover { background: #F1F5F9; }
    .btn-save:hover { background: #2563EB; }
    @media (max-width: 768px) { .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg></div>
            <div><div class="form-header-title">Create New Product</div><div class="form-header-subtitle">Add product details to your inventory</div></div>
        </div>

        @if($errors->any())
            <div style="padding: 0 28px; margin-top: 20px;"><div style="background:#FEF2F2; border:1px solid #FECACA; padding:12px 16px; color:#DC2626; font-size:12px;"><ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <!-- Basic Info -->
                <div class="form-section">
                    <div class="section-title">Basic Information</div>
                    <div class="grid-2">
                        <div class="form-group full">
                            <label class="form-label">Product Name <span class="req">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku') }}" class="form-input" placeholder="Auto-generated">
                            <span class="form-hint">Leave empty for auto-generate</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode" value="{{ old('barcode') }}" class="form-input" placeholder="Barcode number">
                        </div>
                        <div class="form-group full">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-textarea" placeholder="Product description...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="form-section">
                    <div class="section-title">Pricing</div>
                    <div class="grid-3">
                        <div class="form-group">
                            <label class="form-label">Cost Price <span class="req">*</span></label>
                            <input type="number" name="cost_price" value="{{ old('cost_price') }}" class="form-input" placeholder="0.00" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Selling Price <span class="req">*</span></label>
                            <input type="number" name="selling_price" value="{{ old('selling_price') }}" class="form-input" placeholder="0.00" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Wholesale Price</label>
                            <input type="number" name="wholesale_price" value="{{ old('wholesale_price') }}" class="form-input" placeholder="0.00" step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tax (%)</label>
                            <input type="number" name="tax_percentage" value="{{ old('tax_percentage', 0) }}" class="form-input" placeholder="0" min="0" max="100">
                        </div>
                    </div>
                </div>

                <!-- Relations -->
                <div class="form-section">
                    <div class="section-title">Category & Brand</div>
                    <div class="grid-3">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Unit</label>
                            <select name="unit_id" class="form-select">
                                <option value="">Select Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }} ({{ $unit->code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Stock -->
                <div class="form-section">
                    <div class="section-title">Stock</div>
                    <div class="grid-3">
                        <div class="form-group">
                            <label class="form-label">Quantity <span class="req">*</span></label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Min Stock Alert</label>
                            <input type="number" name="min_stock_quantity" value="{{ old('min_stock_quantity', 5) }}" class="form-input">
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="form-section">
                    <div class="section-title">Product Image</div>
                    <div class="file-upload" onclick="document.getElementById('imgInput').click()">
                        <div style="font-size:13px;font-weight:600;color:#475569;">Click to upload product image</div>
                        <div style="font-size:10px;color:#94A3B8;margin-top:4px;">JPG, PNG, GIF, WebP (Max 2MB)</div>
                    </div>
                    <input type="file" id="imgInput" name="image" accept="image/*" style="display:none;">
                </div>

                <!-- Active -->
                <div class="form-section" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" checked style="width:16px;height:16px;">
                        <span style="font-size:13px;font-weight:600;color:#334155;">Active - Product visible in system</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection