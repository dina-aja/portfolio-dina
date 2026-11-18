<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function show(BlogPost $post)
    {
        abort_unless($post->published_at, 404);

        return view('blog.show', [
            'post' => $post,
            'related' => BlogPost::whereNotNull('published_at')
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
            'settings' => \App\Models\Setting::values(),
        ]);
    }
}
