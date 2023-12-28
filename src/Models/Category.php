<?php

namespace MrVaco\OrchidBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'mr_vaco__blog_categories';

    protected $fillable = [
        'name',
        'slug',
        'keywords',
        'tags',
        'description',
        'status',
        'image',
        'creator_id',
        'updator_id',
        'hidden',
    ];

    protected $casts = [
        'status'     => 'integer',
        'creator_id' => 'integer',
        'updator_id' => 'integer',
        'hidden'     => 'boolean',
    ];
}
