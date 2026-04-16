<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'name',
        'category',
        'power',
        'unit',
        'qty',
        'quality',
        'function',
        'sort_order',
        'status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
