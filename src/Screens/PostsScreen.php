<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use MrVaco\OrchidBlog\Models\Post;
use MrVaco\OrchidBlog\Tables\PostsTable;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PostsScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'posts' => Post::query()->get()
        ];
    }

    public function name(): ?string
    {
        return 'Posts';
    }

    public function layout(): iterable
    {
        return [
            Layout::table('posts', PostsTable::columns())
        ];
    }
}
