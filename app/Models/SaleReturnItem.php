<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleReturnItem extends Model
{
    protected $fillable = [
        'sale_return_id', 'product_id', 'sale_item_id',
        'product_name', 'unit_price', 'quantity', 'total_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function saleReturn() { return $this->belongsTo(SaleReturn::class); }
    public function product() { return $this->belongsTo(Product::class); }
}