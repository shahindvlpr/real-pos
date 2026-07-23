<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'description',
        'cost_price',
        'selling_price',
        'wholesale_price',
        'stock_quantity',
        'min_stock_quantity',
        'max_stock_quantity',
        'category_id',
        'brand_id',
        'unit_id',
        'tax_percentage',
        'is_tax_included',
        'has_variants',
        'is_active',
        'image',
        'barcode_symbology'
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'is_tax_included' => 'boolean',
        'has_variants' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Category Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Brand Relationship
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Unit Relationship
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Scope for Active Products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for Low Stock
    public function scopeLowStock($query)
    {
        return $query->where('stock_quantity', '<=', 'min_stock_quantity');
    }

    // Check if low stock
    public function isLowStock()
    {
        return $this->stock_quantity <= $this->min_stock_quantity;
    }

    // Get profit margin
    public function profitMargin()
    {
        if ($this->cost_price > 0) {
            return (($this->selling_price - $this->cost_price) / $this->cost_price) * 100;
        }
        return 0;
    }
}