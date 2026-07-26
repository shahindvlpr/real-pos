<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    protected $fillable = [
        'return_no', 'sale_id', 'customer_id', 'user_id',
        'total_amount', 'refund_amount', 'reason', 'status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
    ];

    public function items() { return $this->hasMany(SaleReturnItem::class); }
    public function sale() { return $this->belongsTo(Sale::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function user() { return $this->belongsTo(User::class); }

    public static function generateReturnNo(): string
    {
        $prefix = 'RET-';
        $last = self::latest()->first();
        $number = $last ? intval(substr($last->return_no, 4)) + 1 : 10001;
        return $prefix . $number;
    }
}