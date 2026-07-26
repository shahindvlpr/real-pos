<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Stock Overview
    public function index()
    {
        $products = Product::with(['category', 'unit'])
            ->orderBy('stock_quantity')
            ->paginate(15);
        
        $lowStock = Product::whereColumn('stock_quantity', '<=', 'min_stock_quantity')->count();
        $outOfStock = Product::where('stock_quantity', 0)->count();
        $totalStock = Product::sum('stock_quantity');

        return view('admin.inventory.index', compact('products', 'lowStock', 'outOfStock', 'totalStock'));
    }

    // Stock In Form
    public function stockIn()
    {
        $products = Product::active()->get();
        return view('admin.inventory.stock-in', compact('products'));
    }

    // Stock In Store
    public function stockInStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $beforeQty = $product->stock_quantity;
        $product->increment('stock_quantity', $request->quantity);
        
        StockTransaction::create([
            'product_id' => $product->id,
            'type' => 'stock_in',
            'quantity' => $request->quantity,
            'before_quantity' => $beforeQty,
            'after_quantity' => $product->fresh()->stock_quantity,
            'reference_type' => 'Manual',
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Stock added!');
    }

    // Stock Out Form
    public function stockOut()
    {
        $products = Product::active()->get();
        return view('admin.inventory.stock-out', compact('products'));
    }

    // Stock Out Store
    public function stockOutStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($request->quantity > $product->stock_quantity) {
            return back()->with('error', 'Insufficient stock!');
        }
        
        $beforeQty = $product->stock_quantity;
        $product->decrement('stock_quantity', $request->quantity);
        
        StockTransaction::create([
            'product_id' => $product->id,
            'type' => 'stock_out',
            'quantity' => $request->quantity,
            'before_quantity' => $beforeQty,
            'after_quantity' => $product->fresh()->stock_quantity,
            'reference_type' => 'Manual',
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Stock removed!');
    }

    // Stock History
    public function history(Request $request)
    {
        $query = StockTransaction::with(['product', 'user'])->latest();

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $transactions = $query->paginate(20);
        $products = Product::all();

        return view('admin.inventory.history', compact('transactions', 'products'));
    }

    // Stock Report (NEW)
    public function report()
    {
        $products = Product::with(['category'])
            ->orderBy('stock_quantity')
            ->get();
        
        $totalStockValue = $products->sum(function($p) {
            return $p->stock_quantity * $p->cost_price;
        });

        return view('admin.inventory.report', compact('products', 'totalStockValue'));
    }
}