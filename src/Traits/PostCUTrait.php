<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Post;
use MrVaco\OrchidBlog\Rows\PostCURows;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

trait PostCUTrait
{
    public $post;

    public function query(Post $post): iterable
    {
        return [
            'post' => $post,
        ];
    }

    public function name(): ?string
    {
        return $this->post->exists
            ? __(BlogEnums::prefixPlugin . '::plugin_blog.update :name', ['name' => $this->post->title])
            : __(BlogEnums::prefixPlugin . '::plugin_blog.create post');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(BlogEnums::postView),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->post->exists)
                ->confirm(__(BlogEnums::prefixPlugin . '::plugin_blog.confirm_delete'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::split([
                PostCURows::class,
                Layout::rows((array) PostCURows::fieldsSecondary()),
            ])->ratio('70/30'),

            Layout::tabs([
                __(BlogEnums::prefixPlugin . '::plugin_blog.introductory') => Layout::rows((array) PostCURows::fieldsTabs(1)),
                __(BlogEnums::prefixPlugin . '::plugin_blog.content')      => Layout::rows((array) PostCURows::fieldsTabs(2)),
            ]),
        ];
    }

    public function save(Post $post, Request $request): RedirectResponse
    {
        $request->validate([
            'post.title' => [
                'required',
            ],
            'post.slug' => [
                'required',
            ],
        ]);

        $post->fill($request->collect('post')->toArray())->save();

        Toast::success(__(BlogEnums::prefixPlugin . '::plugin_blog.saved'));

        return redirect()->route(BlogEnums::postView);
    }

    public function remove(Post $post): RedirectResponse
    {
        $post->delete();

        Toast::info(__(BlogEnums::prefixPlugin . '::plugin_blog.deleted'));

        return redirect()->route(BlogEnums::postView);
    }
}
