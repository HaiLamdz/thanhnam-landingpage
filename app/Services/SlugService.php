<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    public function generate(string $title, string $modelClass, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        if (empty($base)) {
            $base = 'item';
        }

        $slug = $base;
        $count = 1;

        while (true) {
            $query = $modelClass::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            if (!$query->exists()) {
                break;
            }
            $slug = $base . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
