<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Blog\Screens;

use MrVaco\Orchid\Blog\Classes\BlogEnum;
use MrVaco\Orchid\Blog\Classes\CategoryCUTrait;
use Orchid\Screen\Screen;

class CategoryCreateScreen extends Screen
{
    use CategoryCUTrait;

    public function permission(): ?iterable
    {
        return [BlogEnum::categoryCreate];
    }
}
