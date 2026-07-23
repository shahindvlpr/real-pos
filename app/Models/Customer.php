<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'notes',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Sales Relationship
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Scope for Active Customers
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}