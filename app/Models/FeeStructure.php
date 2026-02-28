<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = [
        'course_name',
        'type',
        'fees',
        'discount',
        'after_discount',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'fees'           => 'float',
        'discount'       => 'float',
        'after_discount' => 'float',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
