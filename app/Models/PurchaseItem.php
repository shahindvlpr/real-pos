<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id', 'product_id', 'product_name',
        'product_sku', 'unit_price', 'quantity', 'total_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function purchase() { return $this->belongsTo(Purchase::class); }
    public function product() { return $this->belongsTo(Product::class); }
}