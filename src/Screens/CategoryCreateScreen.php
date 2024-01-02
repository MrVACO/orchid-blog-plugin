<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Traits\CategoryCUTrait;
use Orchid\Screen\Screen;

class CategoryCreateScreen extends Screen
{
    use CategoryCUTrait;

    public function permission(): ?iterable
    {
        return [BlogEnums::categoryCreate];
    }
}
