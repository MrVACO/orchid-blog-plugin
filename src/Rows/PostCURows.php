<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Rows;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidStatuses\Classes\StatusClass;
use MrVaco\OrchidStatuses\Models\StatusModel;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class PostCURows extends Rows
{
    const style_width = 'width:100%; max-width:100%';

    protected function fields(): iterable
    {
        return [
            Input::make('post.title')
                ->title(__('Name'))
                ->type('text')
                ->max(255)
                ->required()
                ->style(self::style_width),

            Input::make('post.slug')
                ->title(__('Slug'))
                ->type('text')
                ->max(255)
                ->style(self::style_width),

            Input::make('post.keywords')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.keywords'))
                ->type('text')
                ->max(255)
                ->style(self::style_width),

            Input::make('post.tags')
                ->title(__('Tags'))
                ->type('text')
                ->max(255)
                ->style(self::style_width),

            Input::make('post.creator_id')->value(auth()->user()->id)->hidden(),
            Input::make('post.updator_id')->value(auth()->user()->id)->hidden(),
        ];
    }

    static public function fieldsSecondary(): array
    {
        return [
            Relation::make('post.category_id')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.category'))
                ->fromModel(Category::class, 'name')
                ->applyScope('active')
                ->value(1),

            Relation::make('post.status')
                ->title(__('Status'))
                ->fromModel(StatusModel::class, 'name')
                ->value(StatusClass::ACTIVE()->id),

            DateTimer::make('post.published_at')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.published_at'))
                ->format24hr()
                ->enableTime(),

            CheckBox::make('post.recommended')
                ->title(BlogEnums::prefixPlugin . '::plugin_blog.recommended')
                ->value(false)
                ->sendTrueOrFalse()
                ->placeholder(__('Yes')),
        ];
    }

    static public function fieldsAfter(): array
    {
        return [
            Cropper::make('post.image')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.image'))
                ->minCanvas(300)
                ->maxCanvas(450)
                ->targetId(),

            Quill::make('post.introductory')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.introductory'))
                ->type('text')
                ->max(255)
                ->height('200px')
                ->required(),

            Quill::make('post.content')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.content'))
                ->type('text')
                ->max(255)
                ->height('600px')
                ->required(),
        ];
    }
}
