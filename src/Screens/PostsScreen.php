<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Post;
use MrVaco\OrchidBlog\Tables\PostsTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PostsScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'posts' => Post::query()
                ->orderByDesc('published_at')
                ->paginate(20)
        ];
    }

    public function name(): ?string
    {
        return __(BlogEnums::prefixPlugin . '::plugin_blog.posts');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->route(BlogEnums::postCreate),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('posts', PostsTable::columns())
        ];
    }

    public function remove(Request $request): RedirectResponse
    {
        $post = Post::query()->findOrFail($request->get('id'));
        $post->delete();

        Toast::info(__(BlogEnums::prefixPlugin . '::plugin_blog.removed'));

        return redirect()->route(BlogEnums::postView);
    }
}
