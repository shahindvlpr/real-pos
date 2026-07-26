<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_no', 'supplier_id', 'user_id',
        'subtotal', 'tax', 'total', 'paid', 'due',
        'payment_method', 'payment_status', 'notes', 'status'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
        'due' => 'decimal:2',
    ];

    public function items() { return $this->hasMany(PurchaseItem::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function user() { return $this->belongsTo(User::class); }

    public static function generateInvoiceNo(): string
    {
        $prefix = 'PO-';
        $last = self::latest()->first();
        $number = $last ? intval(substr($last->invoice_no, 3)) + 1 : 10001;
        return $prefix . $number;
    }
}