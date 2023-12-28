<?php

declare(strict_types = 1);

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Screens\PostsScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->prefix('blog')
    ->group(static function()
    {
        app('router')
            ->screen('posts', PostsScreen::class)
            ->name(BlogEnums::postView)
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Posts'))
            );
    });
