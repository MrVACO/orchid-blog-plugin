<?php

namespace MrVaco\OrchidBlog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use AsSource;

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

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('status', StatusClass::ACTIVE()->id)
            ->where('hidden', false);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
