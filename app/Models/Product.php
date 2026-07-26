<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'sku', 'barcode', 'description',
        'cost_price', 'selling_price', 'wholesale_price',
        'stock_quantity', 'min_stock_quantity', 'max_stock_quantity',
        'category_id', 'brand_id', 'unit_id',
        'tax_percentage', 'is_tax_included',
        'has_variants', 'is_active',
        'image', 'barcode_symbology'
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'is_tax_included' => 'boolean',
        'has_variants' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function unit() { return $this->belongsTo(Unit::class); }
    
    // Sale Items Relationship
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Purchase Items Relationship
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    
    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeLowStock($query) { return $query->whereColumn('stock_quantity', '<=', 'min_stock_quantity'); }
    public function isLowStock(): bool { return $this->stock_quantity <= $this->min_stock_quantity; }
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}