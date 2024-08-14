<?php

declare(strict_types = 1);

use MrVaco\Orchid\Blog\Classes\BlogEnum;
use MrVaco\Orchid\Blog\Screens\CategoryCreateScreen;
use MrVaco\Orchid\Blog\Screens\CategoryScreen;
use MrVaco\Orchid\Blog\Screens\CategoryUpdateScreen;
use MrVaco\Orchid\Blog\Screens\PostCreateScreen;
use MrVaco\Orchid\Blog\Screens\PostScreen;
use MrVaco\Orchid\Blog\Screens\PostUpdateScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->prefix('blog')
    ->group(static function () {
        app('router')
            ->name('')
            ->prefix('posts')
            ->group(static function () {
                app('router')
                    ->screen('', PostScreen::class)
                    ->name(BlogEnum::postView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Posts'))
                    );

                app('router')
                    ->screen('create', PostCreateScreen::class)
                    ->name(BlogEnum::postCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Posts'), route(BlogEnum::postView))
                        ->push(__('Create post'))
                    );

                app('router')
                    ->screen('{post}/update', PostUpdateScreen::class)
                    ->name(BlogEnum::postUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Posts'), route(BlogEnum::postView))
                        ->push(__('Update post'))
                    );
            });

        app('router')
            ->name('')
            ->prefix('categories')
            ->group(static function () {
                app('router')
                    ->screen('', CategoryScreen::class)
                    ->name(BlogEnum::categoryView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Categories'))
                    );

                app('router')
                    ->screen('create', CategoryCreateScreen::class)
                    ->name(BlogEnum::categoryCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Categories'), route(BlogEnum::categoryView))
                        ->push(__('Create category'))
                    );

                app('router')
                    ->screen('{category}/update', CategoryUpdateScreen::class)
                    ->name(BlogEnum::categoryUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Blog'), route(BlogEnum::postView))
                        ->push(__('Categories'), route(BlogEnum::categoryView))
                        ->push(__('Update category'))
                    );
            });
    });
