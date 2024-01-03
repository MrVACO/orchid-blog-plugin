<?php

namespace MrVaco\OrchidBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MrVaco\OrchidGalleryPlugin\Models\Gallery;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Attachable, Filterable;

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
        'gallery_id'
    ];

    protected $casts = [
        'category_id'  => 'integer',
        'status'       => 'integer',
        'image'        => 'integer',
        'creator_id'   => 'integer',
        'updator_id'   => 'integer',
        'published_at' => 'datetime',
        'recommended'  => 'boolean',
        'gallery_id'   => 'integer',
    ];

    protected array $allowedSorts = [
        'title',
        'status',
        'recommended',
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
