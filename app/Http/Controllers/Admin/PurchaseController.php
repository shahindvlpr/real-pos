<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'items'])->latest()->paginate(10);
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::active()->get();
        $products = Product::active()->get();
        return view('admin.purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,bank,bkash',
        ]);

        $subtotal = 0;
        foreach ($request->product_id as $key => $productId) {
            $subtotal += $request->unit_price[$key] * $request->quantity[$key];
        }

        $paid = $request->paid;
        $due = $subtotal - $paid;

        $purchase = Purchase::create([
            'invoice_no' => Purchase::generateInvoiceNo(),
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->id(),
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'paid' => $paid,
            'due' => $due > 0 ? $due : 0,
            'payment_method' => $request->payment_method,
            'payment_status' => $due > 0 ? 'partial' : 'paid',
        ]);

        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $productId,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'unit_price' => $request->unit_price[$key],
                'quantity' => $request->quantity[$key],
                'total_price' => $request->unit_price[$key] * $request->quantity[$key],
            ]);

            // Increase stock
            $product->increment('stock_quantity', $request->quantity[$key]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase order created! Stock updated.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);
        return view('admin.purchases.show', compact('purchase'));
    }

    public function destroy(Purchase $purchase)
    {
        // Restore stock
        foreach ($purchase->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock_quantity', $item->quantity);
            }
        }
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted & stock restored!');
    }
}