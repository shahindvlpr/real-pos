<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            width: 80mm;
            margin: 0 auto;
            padding: 5mm;
            background: #FFF;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .text-lg { font-size: 16px; }
        .text-sm { font-size: 10px; }
        .border-bottom { border-bottom: 1px dashed #000; }
        .border-top { border-top: 1px dashed #000; }
        .py-2 { padding: 4px 0; }
        .my-2 { margin: 4px 0; }
        .line-item { display: flex; justify-content: space-between; padding: 2px 0; }
        .line-item .qty { width: 25px; }
        .line-item .name { flex: 1; }
        .line-item .price { width: 70px; text-align: right; }
        
        @media print {
            body { margin: 0; padding: 2mm; }
            @page { margin: 0; size: 80mm auto; }
        }
    </style>
</head>
<body>
    @php $sale = \App\Models\Sale::with('items')->find(request()->segment(3)); @endphp
    
    @if($sale)
    <!-- Header -->
    <div class="text-center bold text-lg">{{ \App\Models\Setting::get('company_name', 'REAL POS') }}</div>
    <div class="text-center text-sm">{{ \App\Models\Setting::get('company_address', 'Dhaka, Bangladesh') }}</div>
    <div class="text-center text-sm">Phone: {{ \App\Models\Setting::get('company_phone', 'N/A') }}</div>
    <div class="border-bottom my-2"></div>
    
    <!-- Invoice Info -->
    <div class="line-item"><span>Invoice:</span><span class="bold">{{ $sale->invoice_no }}</span></div>
    <div class="line-item"><span>Date:</span><span>{{ $sale->created_at->format('d/m/Y h:i A') }}</span></div>
    <div class="line-item"><span>Customer:</span><span>{{ $sale->customer->name ?? 'Walk-in' }}</span></div>
    <div class="border-bottom my-2"></div>
    
    <!-- Items -->
    <div class="line-item bold">
        <span class="qty">Qty</span>
        <span class="name">Item</span>
        <span class="price">Price</span>
    </div>
    <div class="border-bottom my-2"></div>
    
    @foreach($sale->items as $item)
        <div class="line-item">
            <span class="qty">{{ $item->quantity }}x</span>
            <span class="name">{{ Str::limit($item->product_name, 20) }}</span>
            <span class="price">৳{{ number_format($item->total_price, 0) }}</span>
        </div>
    @endforeach
    
    <div class="border-bottom my-2"></div>
    
    <!-- Total -->
    <div class="line-item text-lg bold">
        <span>TOTAL</span>
        <span>৳{{ number_format($sale->total, 0) }}</span>
    </div>
    
    @if($sale->discount > 0)
        <div class="line-item"><span>Discount</span><span>-৳{{ number_format($sale->discount, 0) }}</span></div>
    @endif
    
    <div class="line-item"><span>Payment</span><span>{{ strtoupper($sale->payment_method) }}</span></div>
    <div class="line-item"><span>Paid</span><span>৳{{ number_format($sale->paid, 0) }}</span></div>
    
    @if($sale->due > 0)
        <div class="line-item bold"><span>Due</span><span>৳{{ number_format($sale->due, 0) }}</span></div>
    @endif
    
    <div class="border-bottom my-2"></div>
    
    <!-- Footer -->
    <div class="text-center text-sm">{{ \App\Models\Setting::get('invoice_footer', 'Thank you!') }}</div>
    <div class="text-center text-sm">{{ \App\Models\Setting::get('invoice_terms', 'Goods sold are not returnable.') }}</div>
    <div class="text-center py-2">&copy; {{ date('Y') }} Real POS</div>
    @endif
    
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 500);
        }
    </script>
</body>
</html>