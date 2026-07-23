<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Products Relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scope for Active Brands
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}