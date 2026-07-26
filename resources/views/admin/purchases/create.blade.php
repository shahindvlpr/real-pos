@extends('layouts.admin')

@section('title', 'New Purchase')
@section('page-title', 'New Purchase')
@section('page-subtitle', 'Create a purchase order')

@push('styles')
<style>
    .form-wrapper {margin: 0 auto; width: 100%; }
    .form-card { background: #FFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; }
    .form-body { padding: 28px; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 10px; }
    .form-group { display: flex; flex-direction: column; gap: 4px; margin-bottom: 14px; }
    .form-label { font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; }
    .form-input, .form-select { padding: 9px 12px; border: 1px solid #E2E8F0; font-size: 13px; font-family: 'Inter', sans-serif; width: 100%; }
    .item-row { display: grid; grid-template-columns: 2fr 1fr 1fr 80px 30px; gap: 8px; align-items: end; margin-bottom: 8px; }
    .btn-sm { padding: 8px 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; cursor: pointer; border: 1px solid; }
    .btn-add-row { background: #EFF6FF; color: #3B82F6; border-color: #3B82F6; }
    .btn-remove { background: #FEF2F2; color: #EF4444; border-color: #EF4444; padding: 7px 10px; cursor: pointer; }
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-save { padding: 10px 24px; background: #3B82F6; border: 1px solid #3B82F6; color: #FFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <div><div style="font-size:15px;font-weight:700;color:#0F172A;">Create Purchase Order</div><div style="font-size:11px;color:#94A3B8;">Add products to purchase</div></div>
        </div>

        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div class="form-body">
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="bank">Bank</option>
                            <option value="bkash">Bkash</option>
                        </select>
                    </div>
                </div>

                <div style="margin:20px 0;">
                    <label class="form-label" style="margin-bottom:8px;">Products</label>
                    <div id="itemsContainer">
                        <div class="item-row">
                            <div><select name="product_id[]" class="form-select" required><option value="">Select Product</option>@foreach($products as $p)<option value="{{ $p->id }}">{{ $p->name }} ({{ $p->sku }})</option>@endforeach</select></div>
                            <div><input type="number" name="quantity[]" class="form-input" placeholder="Qty" value="1" required></div>
                            <div><input type="number" name="unit_price[]" class="form-input" placeholder="Price" step="0.01" required></div>
                            <div><input type="text" class="form-input" placeholder="Total" readonly style="background:#F8FAFC;"></div>
                            <button type="button" class="btn-remove" onclick="removeRow(this)">✕</button>
                        </div>
                    </div>
                    <button type="button" class="btn-sm btn-add-row" onclick="addRow()" style="margin-top:8px;">+ Add Product</button>
                </div>

                <div class="form-group">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" name="paid" class="form-input" value="0" step="0.01" required style="max-width:250px;">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('purchases.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Purchase</button>
            </div>
        </form>
    </div>
</div>

<script>
    function addRow() {
        const container = document.getElementById('itemsContainer');
        const row = document.createElement('div');
        row.className = 'item-row';
        row.innerHTML = `
            <div><select name="product_id[]" class="form-select" required><option value="">Select Product</option>@foreach($products as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select></div>
            <div><input type="number" name="quantity[]" class="form-input" placeholder="Qty" value="1" required></div>
            <div><input type="number" name="unit_price[]" class="form-input" placeholder="Price" step="0.01" required></div>
            <div><input type="text" class="form-input" placeholder="Total" readonly style="background:#F8FAFC;"></div>
            <button type="button" class="btn-remove" onclick="removeRow(this)">✕</button>
        `;
        container.appendChild(row);
    }

    function removeRow(btn) {
        const rows = document.querySelectorAll('.item-row');
        if (rows.length > 1) btn.closest('.item-row').remove();
    }
</script>
@endsection