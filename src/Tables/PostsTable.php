<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Tables;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Post;
use MrVaco\OrchidHelperCode\Screens\Tables\TDBoolean;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\TD;

class PostsTable
{
    static public function columns(): array
    {
        return [
            TD::make('title', __('Title'))
                ->cantHide(),

            TD::make('slug', __('Slug'))
                ->defaultHidden(),

            TD::make('category', __(BlogEnums::prefixPlugin . '::plugin_blog.category'))
                ->render(fn ($post) => $post->category->name),

            TD::make('status', __('Status'))
                ->alignCenter()
                ->render(fn ($status) => view(StatusEnum::prefixPlugin . '::status_preview', [
                    'status' => StatusClass::BY_ID($status->status)
                ])),

            TD::make('image', __('Image'))
                ->defaultHidden(),

            TDBoolean::make('recommended', __(BlogEnums::prefixPlugin . '::plugin_blog.recommended'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TD::make('published_at', __(BlogEnums::prefixPlugin . '::plugin_blog.published_at'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->defaultHidden()
                ->sort(),

            TD::make(__('Actions'))
                ->alignCenter()
                ->width('100px')
                ->canSee(auth()->user()->hasAnyAccess([BlogEnums::postUpdate, BlogEnums::postDelete]))
                ->render(fn (Post $post) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->icon('bs.pencil')
                            ->canSee(auth()->user()->hasAccess(BlogEnums::postUpdate))
                            ->route(BlogEnums::postUpdate, $post->id),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->canSee(auth()->user()->hasAccess(BlogEnums::postDelete))
                            ->confirm(__(BlogEnums::prefixPlugin . '::plugin_blog.confirm_delete'))
                            ->method('remove', ['id' => $post->id]),
                    ]))
                ->cantHide(),
        ];
    }
}
