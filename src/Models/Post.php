<?php

namespace MrVaco\OrchidBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource;

    protected $table = 'mr_vaco__blog_posts';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'keywords',
        'tags',
        'introductory',
        'content',
        'status',
        'image',
        'creator_id',
        'updator_id',
        'published_at',
        'recommended',
    ];

    protected $casts = [
        'category_id'  => 'integer',
        'status'       => 'integer',
        'creator_id'   => 'integer',
        'updator_id'   => 'integer',
        'published_at' => 'datetime',
        'recommended'  => 'boolean',
    ];
}
