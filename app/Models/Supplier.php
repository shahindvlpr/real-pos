<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'tax_number',
        'notes',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Purchases Relationship
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // Scope for Active Suppliers
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}