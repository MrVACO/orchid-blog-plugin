<?php

namespace MrVaco\OrchidBlog;

use MrVaco\HelperCode\Classes\Migrations;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;

class BlogServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        $this->publish();
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
        ], 'plugin-migrations');
    }
}
