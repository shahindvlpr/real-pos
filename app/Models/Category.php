<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Boot method for auto-generating slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Parent Category Relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Child Categories Relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Products Relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scope for Active Categories
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for Parent Categories Only
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Get all categories for dropdown
    public static function getForDropdown()
    {
        return self::whereNull('parent_id')
            ->with('children')
            ->get();
    }
}