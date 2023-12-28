<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Tables;

use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
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

            TD::make('status', __('Status'))
                ->alignCenter()
                ->render(fn ($status) => view(StatusEnum::prefixPlugin . '::status_preview', [
                    'status' => StatusClass::BY_ID($status->status)
                ])),

            TD::make('image', __('Image'))
                ->defaultHidden(),

            TD::make('recommended', __('Recommended'))
                ->defaultHidden(),

            TD::make('published_at', __('Published at'))
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
                ->sort(),
        ];
    }
}
