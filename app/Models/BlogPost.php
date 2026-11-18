<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (BlogPost $post) {
            if (empty($post->slug)) {
                $base = Str::slug($post->title);
                $slug = $base;
                $counter = 2;

                while (BlogPost::where('slug', $slug)->when($post->exists, fn ($q) => $q->where('id', '!=', $post->id))->exists()) {
                    $slug = $base . '-' . $counter++;
                }

                $post->slug = $slug;
            }
        });
    }
}
