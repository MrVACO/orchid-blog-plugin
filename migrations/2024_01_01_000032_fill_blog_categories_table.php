<?php

use Illuminate\Database\Migrations\Migration;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidStatuses\Classes\StatusClass;

return new class extends Migration
{
    protected array $categories = [
        [
            'name'       => 'Uncategorized',
            'slug'       => 'uncategorized',
            'creator_id' => 1,
            'updator_id' => 1,
            'hidden'     => true,
        ],
        [
            'name'       => 'News',
            'slug'       => 'news',
            'creator_id' => 1,
            'updator_id' => 1,
        ],
        [
            'name'       => 'Articles',
            'slug'       => 'articles',
            'creator_id' => 1,
            'updator_id' => 1,
        ],
    ];

    public function up(): void
    {
        foreach ($this->categories as $item)
        {
            Category::query()
                ->create(array_merge($item, [
                    'status' => StatusClass::ACTIVE()->id,
                ]));
        }
    }
};
