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

    // Get total purchases
    public function totalPurchases()
    {
        return $this->sales()->count();
    }

    // Get total amount spent
    public function totalSpent()
    {
        return $this->sales()->sum('total');
    }

    // Get last purchase date
    public function lastPurchaseDate()
    {
        return $this->sales()->latest()->first()?->created_at;
    }

    // Scope for Active Customers
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Search scope
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }
}