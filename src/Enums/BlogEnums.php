<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Enums;

enum BlogEnums
{
    const author = 'mr_vaco';

    const prefixPlugin = self::author . '.blog';
    const prefix       = self::prefixPlugin . '.';

    const postfixView   = 'view';
    const postfixCreate = 'create';
    const postfixUpdate = 'update';
    const postfixDelete = 'delete';

    const postView   = self::prefix . 'posts.' . self::postfixView;
    const postCreate = self::prefix . 'posts.' . self::postfixCreate;
    const postUpdate = self::prefix . 'posts.' . self::postfixUpdate;
    const postDelete = self::prefix . 'posts.' . self::postfixDelete;

    const categoryView   = self::prefix . 'categories.' . self::postfixView;
    const categoryCreate = self::prefix . 'categories.' . self::postfixCreate;
    const categoryUpdate = self::prefix . 'categories.' . self::postfixUpdate;
    const categoryDelete = self::prefix . 'categories.' . self::postfixDelete;
}
