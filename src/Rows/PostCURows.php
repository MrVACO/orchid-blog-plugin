<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Rows;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class PostCURows extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make('post.title')
                ->title(__('Name'))
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal(),

            Input::make('post.slug')
                ->title(__('Slug'))
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal(),

            Input::make('post.keywords')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.keywords'))
                ->type('text')
                ->max(255)
                ->horizontal(),

            Input::make('post.tags')
                ->title(__('Tags'))
                ->type('text')
                ->max(255)
                ->horizontal(),

            Upload::make('post.images')
                ->title(__(BlogEnums::prefixPlugin . '::plugin_blog.image'))
                ->media()
                ->groups('blog'),

            Input::make('post.creator_id')->value(auth()->user()->id)->hidden(),
            Input::make('post.updator_id')->value(auth()->user()->id)->hidden(),
        ];
    }

    static public function fieldsTabs(int $id): iterable
    {
        switch ($id)
        {
            case 1:
            {
                return [
                    Quill::make('post.introductory')
                        ->type('text')
                        ->max(255)
                        ->height('200px'),
                ];
            }
            case 2:
            {
                return [
                    Quill::make('post.content')
                        ->type('text')
                        ->max(255)
                        ->height('600px'),
                ];
            }
            default:
            {
                return [];
            }
        }
    }

    static public function fieldsSecondary(): iterable
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
                ->value(false)
                ->sendTrueOrFalse()
                ->placeholder(BlogEnums::prefixPlugin . '::plugin_blog.recommended'),
        ];
    }
}
