<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Screens;

use MrVaco\OrchidBlog\Enums\BlogEnums;
use MrVaco\OrchidBlog\Traits\PostCUTrait;
use Orchid\Screen\Screen;

class PostUpdateScreen extends Screen
{
    use PostCUTrait;

    public function permission(): ?iterable
    {
        return [BlogEnums::postUpdate];
    }
}
