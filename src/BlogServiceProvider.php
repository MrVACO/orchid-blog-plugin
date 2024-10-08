<?php

namespace MrVaco\Orchid\Blog;

use Illuminate\Support\Facades\Lang;
use MrVaco\Orchid\Blog\Classes\BlogEnum;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class BlogServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        Lang::addJsonPath(__DIR__ . '/../lang');

        $dashboard->registerPermissions(BlogEnum::permissions());
        parent::boot($dashboard);

        $this->publish();
        $this->router();
    }

    public function menu(): array
    {
        $title = __('Blog');

        return [
            Menu::make(__('Posts'))
                ->title($title)
                ->icon('bs.newspaper')
                ->route(BlogEnum::postView)
                ->active(BlogEnum::prefix . 'posts.*')
                ->permission(BlogEnum::postView)
                ->sort(90),

            Menu::make(__('Categories'))
                ->title(auth()->user()->hasAccess(BlogEnum::postView) ? null : $title)
                ->icon('bs.card-list')
                ->route(BlogEnum::categoryView)
                ->active(BlogEnum::prefix . 'categories.*')
                ->permission(BlogEnum::categoryView)
                ->sort(90),
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
            return;

        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations'),
        ], 'plugin-migrations');
    }
}
