<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Blog\Screens;

use MrVaco\Orchid\Blog\Classes\BlogEnum;
use MrVaco\Orchid\Blog\Classes\PostCUTrait;
use Orchid\Screen\Screen;

class PostUpdateScreen extends Screen
{
    use PostCUTrait;

    public function permission(): ?iterable
    {
        return [BlogEnum::postUpdate];
    }
}
