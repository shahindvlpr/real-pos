<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'unit'])->active();

        // Search by name, SKU, or barcode
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('barcode', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->orderBy('name')->paginate(12);
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        // Get cart from session
        $cart = session()->get('pos_cart', []);

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $customers = Customer::active()->orderBy('name')->get();

        return view('admin.pos.index', compact(
            'products', 'categories', 'brands', 'cart', 'subtotal', 'customers'
        ));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        $cart = session()->get('pos_cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->selling_price,
                'quantity' => 1,
                'image' => $product->image,
                'unit' => $product->unit?->code ?? 'PCS',
                'stock' => $product->stock_quantity,
            ];
        }

        // Check stock
        if ($cart[$product->id]['quantity'] > $product->stock_quantity) {
            return response()->json(['error' => 'Insufficient stock! Only ' . $product->stock_quantity . ' available.'], 422);
        }

        session()->put('pos_cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'cart_count' => count($cart),
            'message' => $product->name . ' added to cart!'
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('pos_cart', []);
        
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('pos_cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'cart_count' => count($cart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('pos_cart', []);
        
        if (isset($cart[$request->product_id])) {
            $product = Product::find($request->product_id);
            
            if (!$product) {
                return response()->json(['error' => 'Product not found!'], 422);
            }
            
            if ($request->quantity > $product->stock_quantity) {
                return response()->json(['error' => 'Insufficient stock! Only ' . $product->stock_quantity . ' available.'], 422);
            }
            
            if ($request->quantity <= 0) {
                unset($cart[$request->product_id]);
            } else {
                $cart[$request->product_id]['quantity'] = $request->quantity;
            }
            
            session()->put('pos_cart', $cart);
        }

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('pos_cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty!');
        }

        $request->validate([
            'payment_method' => 'required|in:cash,card,bkash,nagad,rocket,bank',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'customer_id' => 'nullable|exists:customers,id',
            'notes' => 'nullable|string',
        ]);

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $discount = $request->discount ?? 0;
        $total = $subtotal - $discount;
        $paid = $request->paid_amount;
        $due = max($total - $paid, 0);

        // Create Sale
        $sale = Sale::create([
            'invoice_no' => Sale::generateInvoiceNo(),
            'customer_id' => $request->customer_id,
            'user_id' => auth()->id(),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => 0,
            'total' => $total,
            'paid' => $paid,
            'due' => $due,
            'payment_method' => $request->payment_method,
            'payment_status' => $due > 0 ? 'partial' : 'paid',
            'notes' => $request->notes,
        ]);

        // Create Sale Items & Update Stock
        foreach ($cart as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_sku' => $item['sku'],
                'unit_price' => $item['price'],
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);

            // Reduce stock
            $product = Product::find($item['id']);
            if ($product) {
                $product->decrement('stock_quantity', $item['quantity']);
            }
        }

        // Clear cart
        session()->forget('pos_cart');

        // Redirect to print-friendly invoice
        return redirect()->route('pos.print', $sale->id)
            ->with('success', 'Sale completed! Invoice: ' . $sale->invoice_no);
    }

    public function invoice($id)
    {
        $sale = Sale::with(['items', 'customer'])->findOrFail($id);
        return view('admin.pos.invoice', compact('sale'));
    }

    public function printInvoice($id)
    {
        $sale = Sale::with(['items', 'customer'])->findOrFail($id);
        return view('admin.pos.print', compact('sale'));
    }
}