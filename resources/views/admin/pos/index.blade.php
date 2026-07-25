@extends('layouts.admin')

@section('title', 'POS Screen')
@section('page-title', 'Point of Sale')
@section('page-subtitle', 'Process sales quickly')

@push('styles')
<style>
    :root {
        --pos-primary: #3B82F6;
        --pos-success: #10B981;
        --pos-danger: #EF4444;
        --pos-warning: #F59E0B;
        --pos-bg: #F8FAFC;
        --pos-card: #FFFFFF;
        --pos-border: #E2E8F0;
    }

    .pos-wrapper {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 0;
        height: calc(100vh - 140px);
        min-height: 650px;
        margin: -8px;
        background: #F1F5F9;
    }

    /* ========== LEFT PANEL ========== */
    .pos-products {
        display: flex;
        flex-direction: column;
        background: #FAFBFC;
        overflow: hidden;
    }

    /* Top Bar */
    .pos-topbar {
        padding: 16px 20px;
        background: #FFFFFF;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .pos-search {
        flex: 1;
        position: relative;
    }

    .pos-search input {
        width: 100%;
        padding: 10px 14px 10px 40px;
        border: 1px solid #E2E8F0;
        background: #F8FAFC;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        color: #0F172A;
        transition: all 0.2s;
    }

    .pos-search input:focus {
        outline: none;
        border-color: #3B82F6;
        background: #FFF;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.06);
    }

    .pos-search svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        stroke: #94A3B8;
    }

    .pos-filter {
        padding: 9px 32px 9px 12px;
        border: 1px solid #E2E8F0;
        background: #F8FAFC;
        font-size: 12px;
        font-family: 'Inter', sans-serif;
        color: #475569;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        min-width: 130px;
    }

    .pos-filter:focus {
        outline: none;
        border-color: #3B82F6;
    }

    /* Product Grid */
    .pos-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        padding: 16px;
        overflow-y: auto;
        flex: 1;
    }

    .pos-grid::-webkit-scrollbar { width: 4px; }
    .pos-grid::-webkit-scrollbar-track { background: transparent; }
    .pos-grid::-webkit-scrollbar-thumb { background: #CBD5E1; }

    .product-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 16px 12px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #3B82F6;
        transform: scaleX(0);
        transition: transform 0.2s;
    }

    .product-card:hover {
        border-color: #3B82F6;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .product-card:active {
        transform: scale(0.97);
    }

    .pc-image {
        width: 70px;
        height: 70px;
        margin: 0 auto 10px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .pc-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pc-image .pc-emoji {
        font-size: 32px;
        line-height: 1;
    }

    .pc-name {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.3;
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pc-price {
        font-size: 14px;
        font-weight: 800;
        color: #3B82F6;
        letter-spacing: -0.3px;
    }

    .pc-stock {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
        margin-top: 3px;
    }

    .pc-stock.low {
        color: #EF4444;
        font-weight: 600;
    }

    /* Pagination */
    .pos-pagination {
        padding: 12px 16px;
        background: #FFF;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: center;
    }

    /* ========== RIGHT PANEL - CART ========== */
    .pos-cart {
        background: #FFF;
        border-left: 1px solid #E2E8F0;
        display: flex;
        flex-direction: column;
        box-shadow: -4px 0 20px rgba(0,0,0,0.04);
    }

    /* Cart Header */
    .cart-header {
        padding: 18px 20px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #FAFBFC;
    }

    .cart-title {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cart-count {
        background: #3B82F6;
        color: #FFF;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        min-width: 24px;
        text-align: center;
    }

    /* Cart Items */
    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 8px 12px;
    }

    .cart-body::-webkit-scrollbar { width: 3px; }
    .cart-body::-webkit-scrollbar-track { background: transparent; }
    .cart-body::-webkit-scrollbar-thumb { background: #E2E8F0; }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 8px;
        border-bottom: 1px solid #F1F5F9;
        transition: background 0.15s;
    }

    .cart-item-row:hover {
        background: #F8FAFC;
    }

    .cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .cart-item-name {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cart-item-meta {
        font-size: 10px;
        color: #94A3B8;
        margin-top: 2px;
        display: flex;
        gap: 8px;
    }

    .cart-item-price {
        font-size: 11px;
        font-weight: 600;
        color: #64748B;
    }

    /* Quantity */
    .qty-group {
        display: flex;
        align-items: center;
        border: 1px solid #E2E8F0;
        background: #FFF;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border: none;
        background: #F8FAFC;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        font-weight: 500;
        transition: all 0.15s;
    }

    .qty-btn:hover {
        background: #E2E8F0;
        color: #0F172A;
    }

    .qty-btn.minus { border-right: 1px solid #E2E8F0; }
    .qty-btn.plus { border-left: 1px solid #E2E8F0; }

    .qty-value {
        width: 32px;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
        font-family: 'Inter', sans-serif;
        border: none;
        background: transparent;
    }

    .cart-item-total {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        min-width: 65px;
        text-align: right;
    }

    .delete-item {
        width: 24px;
        height: 24px;
        border: none;
        background: none;
        color: #CBD5E1;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
    }

    .delete-item:hover {
        color: #EF4444;
    }

    /* Empty Cart */
    .cart-empty {
        text-align: center;
        padding: 50px 20px;
    }

    .cart-empty-icon {
        width: 72px;
        height: 72px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .cart-empty-icon svg {
        width: 32px;
        height: 32px;
        stroke: #94A3B8;
    }

    /* Cart Footer */
    .cart-footer {
        border-top: 2px solid #E2E8F0;
        background: #FAFBFC;
        padding: 16px 20px;
    }

    .cart-summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #64748B;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .cart-summary-divider {
        border: none;
        border-top: 1px dashed #E2E8F0;
        margin: 10px 0;
    }

    .cart-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-total-label {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
    }

    .cart-total-value {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.5px;
    }

    .btn-checkout {
        width: 100%;
        padding: 13px;
        margin-top: 14px;
        background: #10B981;
        border: none;
        color: #FFF;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-checkout:hover {
        background: #059669;
        box-shadow: 0 4px 15px rgba(16,185,129,0.3);
    }

    .btn-checkout:active {
        transform: scale(0.98);
    }

    .btn-checkout svg {
        width: 16px;
        height: 16px;
    }

    .btn-clear {
        width: 100%;
        padding: 9px;
        margin-top: 8px;
        background: transparent;
        border: 1px solid #E2E8F0;
        color: #94A3B8;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-clear:hover {
        color: #EF4444;
        border-color: #FECACA;
        background: #FEF2F2;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1400px) {
        .pos-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 1200px) {
        .pos-wrapper { grid-template-columns: 1fr 380px; }
        .pos-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 992px) {
        .pos-wrapper { grid-template-columns: 1fr; height: auto; }
        .pos-grid { grid-template-columns: repeat(2, 1fr); max-height: 450px; }
        .pos-cart { border-left: none; border-top: 1px solid #E2E8F0; max-height: 500px; }
    }

    @media (max-width: 600px) {
        .pos-grid { grid-template-columns: repeat(2, 1fr); }
        .pos-topbar { flex-direction: column; }
    }
</style>
@endpush

@section('content')
<div class="pos-wrapper">
    
    <!-- ============ LEFT: PRODUCTS ============ -->
    <div class="pos-products">
        <!-- Search & Filters -->
        <div class="pos-topbar">
            <div class="pos-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Search products by name, SKU or barcode..." value="{{ request('search') }}">
            </div>
            <select class="pos-filter" id="categoryFilter">
                <option value="">📂 All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select class="pos-filter" id="brandFilter">
                <option value="">🏷️ All Brands</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="display:flex;gap:16px;padding:0 16px 8px;font-size:10px;color:#94A3B8;">
            <span>⌨️ <b>F1</b>: Search</span>
            <span>💳 <b>F2</b>: Payment</span>
            <span>🗑️ <b>F3</b>: Clear Cart</span>
        </div>

        <!-- Product Grid -->
        <div class="pos-grid">
            @forelse($products as $product)
                <div class="product-card" onclick="addToCart({{ $product->id }})">
                    <div class="pc-image">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        @else
                            <span class="pc-emoji">📦</span>
                        @endif
                    </div>
                    <div class="pc-name">{{ $product->name }}</div>
                    <div class="pc-price">৳ {{ number_format($product->selling_price) }}</div>
                    <div class="pc-stock {{ $product->stock_quantity <= $product->min_stock_quantity ? 'low' : '' }}">
                        Stock: {{ $product->stock_quantity }}
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align:center; padding:60px; color:#94A3B8;">
                    <div style="font-size:48px; margin-bottom:12px;">📭</div>
                    <div style="font-weight:600; font-size:15px;">No products found</div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="pos-pagination">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- ============ RIGHT: CART ============ -->
    <div class="pos-cart">
        <!-- Header -->
        <div class="cart-header">
            <div class="cart-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
                Cart
            </div>
            <span class="cart-count" id="cartCount">{{ count($cart) }}</span>
        </div>

        <!-- Customer Selection -->
        <div style="padding: 10px 12px; border-bottom: 1px solid #E2E8F0; background: #FAFBFC;">
            <label style="font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: block;">Customer</label>
            <select id="customerSelect" style="width: 100%; padding: 8px 10px; border: 1px solid #E2E8F0; font-size: 12px; font-family: 'Inter', sans-serif; background: #FFF; color: #0F172A;">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->name == 'Walk-in Customer' ? 'selected' : '' }}>
                        {{ $customer->name }} {{ $customer->phone ? ' - ' . $customer->phone : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cart Items -->
        <div class="cart-body" id="cartBody">
            @if(count($cart) > 0)
                @foreach($cart as $item)
                    <div class="cart-item-row" id="cart-item-{{ $item['id'] }}">
                        <div class="cart-item-info">
                            <div class="cart-item-name">{{ $item['name'] }}</div>
                            <div class="cart-item-meta">
                                <span>SKU: {{ $item['sku'] }}</span>
                                <span class="cart-item-price">৳ {{ number_format($item['price'], 2) }}</span>
                            </div>
                        </div>
                        <div class="qty-group">
                            <button class="qty-btn minus" onclick="updateQty({{ $item['id'] }}, -1)">−</button>
                            <input type="text" class="qty-value" value="{{ $item['quantity'] }}" readonly>
                            <button class="qty-btn plus" onclick="updateQty({{ $item['id'] }}, 1)">+</button>
                        </div>
                        <div class="cart-item-total">৳ {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        <button class="delete-item" onclick="removeItem({{ $item['id'] }})" title="Remove">✕</button>
                    </div>
                @endforeach
            @else
                <div class="cart-empty" id="cartEmpty">
                    <div class="cart-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                        </svg>
                    </div>
                    <div style="font-weight:600; color:#475569; margin-bottom:4px;">Cart is empty</div>
                    <div style="font-size:11px; color:#94A3B8;">Click on products to add them</div>
                </div>
            @endif
        </div>

        <!-- Footer / Summary -->
        <div class="cart-footer">
            <!-- Discount -->
            <div class="cart-summary-row">
                <span>Subtotal</span>
                <span id="subtotal">৳ {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="cart-summary-row">
                <span>Discount</span>
                <div style="display:flex;align-items:center;gap:4px;">
                    <span style="color:#EF4444;">− ৳</span>
                    <input type="number" id="discountInput" value="0" min="0" 
                        style="width:70px;padding:4px 8px;border:1px solid #E2E8F0;font-size:12px;text-align:right;font-family:'Inter',sans-serif;"
                        onchange="updateTotals()" onkeyup="updateTotals()">
                </div>
            </div>
            <div class="cart-summary-row">
                <span>Tax</span>
                <span>৳ 0.00</span>
            </div>
            <hr class="cart-summary-divider">
            <div class="cart-total-row">
                <span class="cart-total-label">Total</span>
                <span class="cart-total-value" id="grandTotal">৳ {{ number_format($subtotal, 2) }}</span>
            </div>

            <!-- Payment Method -->
            <div style="margin-top:12px;">
                <label style="font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;display:block;">Payment Method</label>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px;" id="paymentMethods">
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'cash')">
                        💵 Cash
                    </label>
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'card')">
                        💳 Card
                    </label>
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'bkash')">
                        📱 Bkash
                    </label>
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'nagad')">
                        📱 Nagad
                    </label>
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'rocket')">
                        🚀 Rocket
                    </label>
                    <label class="payment-option" style="display:block;padding:10px 8px;border:1px solid #E2E8F0;text-align:center;cursor:pointer;font-size:11px;font-weight:600;color:#475569;background:#FFF;" onclick="selectPayment(this, 'bank')">
                        🏦 Bank
                    </label>
                </div>
                <input type="hidden" name="payment_method" id="paymentMethod" value="cash">
            </div>

            <!-- Paid Amount -->
            <div style="margin-top:10px;">
                <label style="font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;display:block;">Paid Amount</label>
                <input type="number" id="paidAmount" value="{{ $subtotal }}" min="0" step="0.01"
                    style="width:100%;padding:10px 12px;border:1px solid #E2E8F0;font-size:14px;font-weight:700;color:#0F172A;font-family:'Inter',sans-serif;"
                    onchange="updateTotals()" onkeyup="updateTotals()">
            </div>

            <!-- Change Due -->
            <div id="changeDue" style="margin-top:4px;font-size:12px;font-weight:600;color:#10B981;display:none;">
                Change: ৳ <span id="changeAmount">0.00</span>
            </div>

            <!-- Checkout Button -->
            <button class="btn-checkout" onclick="processCheckout()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Process Payment (F2)
            </button>
            <button class="btn-clear" onclick="clearCart()">Clear All Items (F3)</button>
        </div>
    </div>
</div>

<!-- Hidden Checkout Form -->
<form id="checkoutForm" action="{{ route('pos.checkout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('scripts')
<script>
// =========================================
// POS SYSTEM - COMPLETE ERROR-FREE SCRIPT
// =========================================

const csrfToken = '{{ csrf_token() }}';
const addToCartUrl = '{{ route("pos.add-to-cart") }}';
const updateCartUrl = '{{ route("pos.update-cart") }}';
const removeCartUrl = '{{ route("pos.remove-cart") }}';
const posIndexUrl = '{{ route("pos.index") }}';

// =========================================
// CART FUNCTIONS
// =========================================

function addToCart(productId) {
    fetch(addToCartUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) {
            showToast(data.error, 'error');
        } else {
            location.reload();
        }
    });
}

function updateQty(productId, change) {
    const input = document.querySelector('#cart-item-' + productId + ' .qty-value');
    if (!input) {
        removeItem(productId);
        return;
    }
    
    let newQty = parseInt(input.value) + change;
    
    if (newQty < 1) {
        removeItem(productId);
        return;
    }

    fetch(updateCartUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ product_id: productId, quantity: newQty })
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) {
            showToast(data.error, 'error');
        } else {
            location.reload();
        }
    });
}

function removeItem(productId) {
    fetch(removeCartUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(r => r.json())
    .then(data => location.reload());
}

// =========================================
// PAYMENT & CHECKOUT FUNCTIONS
// =========================================

function selectPayment(element, method) {
    document.querySelectorAll('.payment-option').forEach(function(el) {
        el.style.background = '#FFF';
        el.style.borderColor = '#E2E8F0';
        el.style.color = '#475569';
    });
    element.style.background = '#EFF6FF';
    element.style.borderColor = '#3B82F6';
    element.style.color = '#3B82F6';
    document.getElementById('paymentMethod').value = method;
}

function updateTotals() {
    var subtotalEl = document.getElementById('subtotal');
    if (!subtotalEl) return;
    
    var subtotalText = subtotalEl.textContent.replace('৳ ', '').replace(/,/g, '');
    var subtotal = parseFloat(subtotalText) || 0;
    var discount = parseFloat(document.getElementById('discountInput').value) || 0;
    var total = subtotal - discount;
    var paid = parseFloat(document.getElementById('paidAmount').value) || 0;
    var change = paid - total;
    
    var grandTotal = document.getElementById('grandTotal');
    if (grandTotal) {
        grandTotal.textContent = '৳ ' + total.toFixed(2);
    }
    
    var changeDue = document.getElementById('changeDue');
    var changeAmount = document.getElementById('changeAmount');
    
    if (changeDue && changeAmount) {
        if (change >= 0) {
            changeDue.style.display = 'block';
            changeAmount.textContent = change.toFixed(2);
        } else {
            changeDue.style.display = 'none';
        }
    }
}

function processCheckout() {
    var cartCount = document.getElementById('cartCount');
    if (cartCount && cartCount.textContent == '0') {
        showToast('Cart is empty!', 'error');
        return;
    }
    
    if (confirm('Complete this sale?')) {
        var form = document.getElementById('checkoutForm');
        form.innerHTML = '';
        
        // Token
        var tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = csrfToken;
        form.appendChild(tokenInput);
        
        // Payment Method
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = 'payment_method';
        methodInput.value = document.getElementById('paymentMethod').value;
        form.appendChild(methodInput);
        
        // Discount
        var discountInput = document.createElement('input');
        discountInput.type = 'hidden';
        discountInput.name = 'discount';
        discountInput.value = document.getElementById('discountInput').value || 0;
        form.appendChild(discountInput);
        
        // Paid Amount
        var paidInput = document.createElement('input');
        paidInput.type = 'hidden';
        paidInput.name = 'paid_amount';
        paidInput.value = document.getElementById('paidAmount').value || 0;
        form.appendChild(paidInput);
        
        //Customer ID 
        var customerInput = document.createElement('input');
        customerInput.type = 'hidden';
        customerInput.name = 'customer_id';
        customerInput.value = document.getElementById('customerSelect').value;
        form.appendChild(customerInput);
        
        form.submit();
    }
}

function clearCart() {
    if (!confirm('Remove all items from cart?')) return;
    
    var items = document.querySelectorAll('.cart-item-row');
    var promises = [];
    
    items.forEach(function(item) {
        var id = item.id.replace('cart-item-', '');
        promises.push(
            fetch(removeCartUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: id })
            })
        );
    });
    
    Promise.all(promises).then(function() {
        location.reload();
    });
}

// =========================================
// TOAST NOTIFICATION
// =========================================

function showToast(message, type) {
    var toast = document.createElement('div');
    toast.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;padding:12px 20px;color:#FFF;font-size:13px;font-weight:600;background:' + (type === 'error' ? '#EF4444' : '#10B981') + ';animation:slideIn 0.3s ease;';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(function() {
        toast.remove();
    }, 2000);
}

// =========================================
// FILTERS
// =========================================

var searchInput = document.getElementById('searchInput');
var categoryFilter = document.getElementById('categoryFilter');
var brandFilter = document.getElementById('brandFilter');

if (searchInput) {
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterProducts();
        }
    });
}

if (categoryFilter) {
    categoryFilter.addEventListener('change', filterProducts);
}

if (brandFilter) {
    brandFilter.addEventListener('change', filterProducts);
}

function filterProducts() {
    var search = document.getElementById('searchInput').value;
    var category = document.getElementById('categoryFilter').value;
    var brand = document.getElementById('brandFilter').value;
    var url = posIndexUrl + '?';
    if (search) url += 'search=' + encodeURIComponent(search) + '&';
    if (category) url += 'category=' + category + '&';
    if (brand) url += 'brand=' + brand;
    window.location.href = url;
}

// =========================================
// BARCODE SCANNER INTEGRATION
// =========================================

window.addEventListener('load', function() {
    var searchEl = document.getElementById('searchInput');
    if (searchEl) searchEl.focus();
});

var posProducts = document.querySelector('.pos-products');
if (posProducts) {
    posProducts.addEventListener('click', function(e) {
        if (!e.target.closest('.product-card')) {
            var searchEl = document.getElementById('searchInput');
            if (searchEl) searchEl.focus();
        }
    });
}

var barcodeBuffer = '';
var barcodeTimer = null;
var lastKeyTime = 0;

var searchEl2 = document.getElementById('searchInput');
if (searchEl2) {
    searchEl2.addEventListener('keydown', function(e) {
        var currentTime = new Date().getTime();
        var timeDiff = currentTime - lastKeyTime;
        lastKeyTime = currentTime;
        
        if (e.key === 'Enter') {
            e.preventDefault();
            
            if (barcodeBuffer.length >= 6) {
                searchByBarcode(barcodeBuffer);
            } else {
                filterProducts();
            }
            
            barcodeBuffer = '';
            clearTimeout(barcodeTimer);
            return;
        }
        
        if (timeDiff < 50 && e.key.length === 1) {
            barcodeBuffer += e.key;
            
            clearTimeout(barcodeTimer);
            barcodeTimer = setTimeout(function() {
                if (barcodeBuffer.length >= 8) {
                    searchByBarcode(barcodeBuffer);
                }
                barcodeBuffer = '';
            }, 150);
        } else if (e.key.length === 1) {
            barcodeBuffer = '';
        }
    });
}

function searchByBarcode(barcode) {
    document.getElementById('searchInput').value = barcode;
    window.location.href = posIndexUrl + '?search=' + encodeURIComponent(barcode);
}

// =========================================
// KEYBOARD SHORTCUTS
// =========================================

document.addEventListener('keydown', function(e) {
    if (e.key === 'F1') {
        e.preventDefault();
        var s = document.getElementById('searchInput');
        if (s) { s.focus(); s.select(); }
    }
    
    if (e.key === 'F2') {
        e.preventDefault();
        processCheckout();
    }
    
    if (e.key === 'F3') {
        e.preventDefault();
        clearCart();
    }
    
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        var s2 = document.getElementById('searchInput');
        if (s2) s2.focus();
    }
});

// =========================================
// INITIALIZE
// =========================================

document.addEventListener('DOMContentLoaded', function() {
    var paidAmount = document.getElementById('paidAmount');
    if (paidAmount) {
        var subtotalEl = document.getElementById('subtotal');
        if (subtotalEl) {
            var val = subtotalEl.textContent.replace('৳ ', '').replace(/,/g, '');
            paidAmount.value = parseFloat(val) || 0;
        }
    }
    
    var firstOption = document.querySelector('.payment-option');
    if (firstOption) {
        selectPayment(firstOption, 'cash');
    }
    
    updateTotals();
});

console.log('🖥️ POS Ready!');
console.log('  F1 - Search | F2 - Payment | F3 - Clear Cart');
console.log('  📷 Barcode Scanner Active');
</script>

<style>
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
</style>
@endpush