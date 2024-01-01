<?php

namespace MrVaco\OrchidBlog\Observers;

use Illuminate\Support\Str;
use MrVaco\OrchidBlog\Models\Post;

class PostObserver
{
    public function saving(Post $post): void
    {
        if (empty($post->slug))
            $post->slug = Str::slug($post->title);

        if (empty($post->image))
            $post->attachment()->delete();
    }

    public function deleting(Post $post): void
    {
        $post->attachment()->delete();
    }
}
