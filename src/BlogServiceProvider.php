<?php

namespace MrVaco\OrchidBlog;

use Illuminate\Support\Facades\Lang;
use MrVaco\HelperCode\Classes\Migrations;
use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Post;
use MrVaco\OrchidBlog\Observers\PostObserver;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class BlogServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        Lang::addNamespace(BlogEnums::prefixPlugin, __DIR__ . '/../resources/lang');

        $dashboard->registerPermissions(BlogEnums::permissions());
        parent::boot($dashboard);

        $this->publish();
        $this->router();

        Post::observe(PostObserver::class);
    }

    public function menu(): array
    {
        return [
            Menu::make(__(BlogEnums::prefixPlugin . '::plugin_blog.posts'))
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.plugin_category'))
                ->route(BlogEnums::postView)
                ->active(BlogEnums::prefix . 'posts.*')
                ->sort(100),

            Menu::make(__(BlogEnums::prefixPlugin . '::plugin_blog.categories'))
                ->route(BlogEnums::categoryView)
                ->active(BlogEnums::prefix . 'categories.*')
                ->sort(100),
        ];
    }

    public function router(): void
    {
        app('router')
            ->domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->group(__DIR__ . '/../routes/web.php');
    }

    protected function publish(): void
    {
        if (!$this->app->runningInConsole())
        {
            return;
        }

        $this->publishes([
            __DIR__ . '/../migrations/create_blog_posts_table.php'      => Migrations::getMigrationFileName('create_blog_posts_table.php'),
            __DIR__ . '/../migrations/create_blog_categories_table.php' => Migrations::getMigrationFileName('create_blog_categories_table.php'),
            __DIR__ . '/../migrations/fill_blog_categories_table.php'   => Migrations::getMigrationFileName('fill_blog_categories_table.php'),
        ], 'plugin-migrations');
    }
}
