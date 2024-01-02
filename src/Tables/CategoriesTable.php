<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Tables;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidStatuses\Classes\StatusClass;
use MrVaco\OrchidStatuses\Enums\StatusEnum;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\TD;

class CategoriesTable
{
    static public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->cantHide(),

            TD::make('slug', __('Slug'))
                ->defaultHidden(),

            TD::make('tags', __('Tags'))
                ->defaultHidden(),

            TD::make('posts', __(BlogEnums::prefixPlugin . '::plugin_blog.count_posts'))
                ->alignCenter()
                ->render(fn ($category) => count($category->posts)),

            TD::make('status', __('Status'))
                ->alignCenter()
                ->render(fn ($status) => view(StatusEnum::prefixPlugin . '::status_preview', [
                    'status' => StatusClass::BY_ID($status->status)
                ])),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->sort(),

            TD::make(__('Actions'))
                ->alignCenter()
                ->width('100px')
                ->canSee(auth()->user()->hasAnyAccess([BlogEnums::categoryUpdate, BlogEnums::categoryDelete]))
                ->render(fn (Category $category) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->icon('bs.pencil')
                            ->canSee(auth()->user()->hasAccess(BlogEnums::categoryUpdate))
                            ->route(BlogEnums::categoryUpdate, $category->id),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->canSee(auth()->user()->hasAccess(BlogEnums::categoryDelete))
                            ->confirm(__(BlogEnums::prefixPlugin . '::plugin_blog.confirm_delete'))
                            ->method('remove', ['id' => $category->id]),
                    ]))
                ->cantHide(),
        ];
    }
}
