<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidBlog\Tables\CategoriesTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoriesScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'categories' => Category::query()->get()
        ];
    }

    public function name(): ?string
    {
        return __(BlogEnums::prefixPlugin . '::plugin_blog.categories');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->route(BlogEnums::categoryCreate),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', CategoriesTable::columns())
        ];
    }

    public function remove(Request $request): RedirectResponse
    {
        $category = Category::query()->findOrFail($request->get('id'));
        $category->delete();

        Toast::info(__(BlogEnums::prefixPlugin . '::plugin_blog.removed'));

        return redirect()->route(BlogEnums::categoryView);
    }
}
