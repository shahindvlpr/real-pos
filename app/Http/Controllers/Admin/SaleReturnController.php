<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleReturnController extends Controller
{
    public function index()
    {
        $returns = SaleReturn::with(['sale', 'customer'])->latest()->paginate(10);
        return view('admin.sales.returns.index', compact('returns'));
    }

    public function create()
    {
        return view('admin.sales.returns.create');
    }

    public function findSale(Request $request)
    {
        $request->validate(['invoice_no' => 'required|string']);
        
        $sale = Sale::where('invoice_no', $request->invoice_no)
            ->with(['items.product', 'customer'])
            ->first();

        if (!$sale) {
            return back()->with('error', 'Sale invoice not found!');
        }

        return view('admin.sales.returns.process', compact('sale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'items' => 'required|array',
            'items.*' => 'exists:sale_items,id',
            'quantity.*' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($request->sale_id);
        $totalRefund = 0;

        $return = SaleReturn::create([
            'return_no' => SaleReturn::generateReturnNo(),
            'sale_id' => $sale->id,
            'customer_id' => $sale->customer_id,
            'user_id' => auth()->id(),
            'total_amount' => 0,
            'refund_amount' => 0,
            'reason' => $request->reason,
        ]);

        foreach ($request->items as $itemId) {
            $saleItem = $sale->items()->find($itemId);
            if (!$saleItem) continue;

            $qty = min($request->quantity[$itemId], $saleItem->quantity);
            $totalPrice = $saleItem->unit_price * $qty;
            $totalRefund += $totalPrice;

            SaleReturnItem::create([
                'sale_return_id' => $return->id,
                'product_id' => $saleItem->product_id,
                'sale_item_id' => $saleItem->id,
                'product_name' => $saleItem->product_name,
                'unit_price' => $saleItem->unit_price,
                'quantity' => $qty,
                'total_price' => $totalPrice,
            ]);

            // Restore stock
            if ($saleItem->product) {
                $saleItem->product->increment('stock_quantity', $qty);
            }
        }

        $return->update([
            'total_amount' => $totalRefund,
            'refund_amount' => $totalRefund,
        ]);

        return redirect()->route('admin.sales.returns.index')
            ->with('success', 'Return processed! ' . $return->return_no);
    }

    public function show(SaleReturn $saleReturn)
    {
        $saleReturn->load(['sale', 'customer', 'items.product']);
        return view('admin.sales.returns.show', compact('saleReturn'));
    }
}