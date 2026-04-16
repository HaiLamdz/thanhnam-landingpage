<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityArea extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
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
