<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Rows;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidStatuses\Classes\StatusClass;
use MrVaco\OrchidStatuses\Models\StatusModel;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class CategoryCURows extends Rows
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('category.name')
                    ->title(__('Name'))
                    ->type('text')
                    ->max(255)
                    ->required(),

                Input::make('category.slug')
                    ->title(__('Slug'))
                    ->type('text')
                    ->max(255)
                    ->required(),
            ]),

            Group::make([
                Input::make('category.keywords')
                    ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.keywords'))
                    ->type('text')
                    ->max(255),

                Input::make('category.tags')
                    ->title(__('Tags'))
                    ->type('text')
                    ->max(255),
            ]),

            Relation::make('category.status')
                ->title(__('Status'))
                ->fromModel(StatusModel::class, 'name')
                ->value(StatusClass::ACTIVE()->id)
                ->horizontal(),

            Quill::make('category.description')
                ->title(__('Description'))
                ->type('text')
                ->max(255)
                ->height('200px'),

            Input::make('category.creator_id')->value(auth()->user()->id)->hidden(),
            Input::make('category.updator_id')->value(auth()->user()->id)->hidden(),
        ];
    }
}
