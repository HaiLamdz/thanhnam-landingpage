<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'icon',
        'image_path',
        'status',
        'sort_order',
        'featured',
    ];

    protected $casts = [
        'status'     => 'string',
        'sort_order' => 'integer',
        'featured'   => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}
