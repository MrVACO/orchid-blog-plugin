<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Models\Category;
use MrVaco\OrchidBlog\Rows\CategoryCURows;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

trait CategoryCUTrait
{
    public $category;

    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    public function name(): ?string
    {
        return $this->category->exists
            ? __(BlogEnums::prefixPlugin . '::plugin_blog.update :name', ['name' => $this->category->name])
            : __(BlogEnums::prefixPlugin . '::plugin_blog.create category');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(BlogEnums::categoryView),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->category->exists && auth()->user()->hasAccess(BlogEnums::categoryDelete))
                ->confirm(__(BlogEnums::prefixPlugin . '::plugin_blog.confirm_delete'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->canSee(auth()->user()->hasAccess(BlogEnums::categoryCreate))
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            CategoryCURows::class,
        ];
    }

    public function save(Category $category, Request $request): RedirectResponse
    {
        $request->validate([
            'category.name' => [
                'required',
            ],
            'category.slug' => [
                'required',
            ],
        ]);

        $category->fill($request->collect('category')->toArray())->save();

        Toast::success(__(BlogEnums::prefixPlugin . '::plugin_blog.saved'));

        return redirect()->route(BlogEnums::categoryView);
    }

    public function remove(Category $category): RedirectResponse
    {
        $category->delete();

        Toast::info(__(BlogEnums::prefixPlugin . '::plugin_blog.deleted'));

        return redirect()->route(BlogEnums::categoryView);
    }
}
