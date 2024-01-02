<?php

declare(strict_types = 1);

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Screens\CategoriesScreen;
use MrVaco\OrchidBlog\Screens\CategoryCreateScreen;
use MrVaco\OrchidBlog\Screens\CategoryUpdateScreen;
use MrVaco\OrchidBlog\Screens\PostCreateScreen;
use MrVaco\OrchidBlog\Screens\PostsScreen;
use MrVaco\OrchidBlog\Screens\PostUpdateScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->prefix('blog')
    ->group(static function()
    {
        app('router')
            ->name('')
            ->prefix('posts')
            ->group(static function()
            {
                app('router')
                    ->screen('', PostsScreen::class)
                    ->name(BlogEnums::postView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.posts'))
                    );

                app('router')
                    ->screen('create', PostCreateScreen::class)
                    ->name(BlogEnums::postCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.posts'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.create post'))
                    );

                app('router')
                    ->screen('{post}/update', PostUpdateScreen::class)
                    ->name(BlogEnums::postUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.posts'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.update'))
                    );
            });

        app('router')
            ->name('')
            ->prefix('categories')
            ->group(static function()
            {
                app('router')
                    ->screen('', CategoriesScreen::class)
                    ->name(BlogEnums::categoryView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.categories'))
                    );

                app('router')
                    ->screen('create', CategoryCreateScreen::class)
                    ->name(BlogEnums::categoryCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.categories'), route(BlogEnums::categoryView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.create category'))
                    );

                app('router')
                    ->screen('{category}/update', CategoryUpdateScreen::class)
                    ->name(BlogEnums::categoryUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'), route(BlogEnums::postView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.categories'), route(BlogEnums::categoryView))
                        ->push(__(BlogEnums::prefixPlugin . '::plugin_blog.update'))
                    );
            });
    });
