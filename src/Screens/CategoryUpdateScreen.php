<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Traits\CategoryCUTrait;
use Orchid\Screen\Screen;

class CategoryUpdateScreen extends Screen
{
    use CategoryCUTrait;

    public function permission(): ?iterable
    {
        return [BlogEnums::categoryUpdate];
    }
}
