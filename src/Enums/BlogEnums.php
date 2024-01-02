<?php

declare(strict_types = 1);

namespace MrVaco\OrchidBlog\Enums;

use Orchid\Platform\ItemPermission;

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

    static public function permissions()
    {
        return ItemPermission::group(__(self::prefixPlugin . '::plugin_blog.plugin_category'))
            ->addPermission(self::postView, __(self::prefixPlugin . '::plugin_blog.permissions.post.view'))
            ->addPermission(self::postCreate, __(self::prefixPlugin . '::plugin_blog.permissions.post.create'))
            ->addPermission(self::postUpdate, __(self::prefixPlugin . '::plugin_blog.permissions.post.update'))
            ->addPermission(self::postDelete, __(self::prefixPlugin . '::plugin_blog.permissions.post.delete'))
            ->addPermission(self::categoryView, __(self::prefixPlugin . '::plugin_blog.permissions.category.view'))
            ->addPermission(self::categoryCreate, __(self::prefixPlugin . '::plugin_blog.permissions.category.create'))
            ->addPermission(self::categoryUpdate, __(self::prefixPlugin . '::plugin_blog.permissions.category.update'))
            ->addPermission(self::categoryDelete, __(self::prefixPlugin . '::plugin_blog.permissions.category.delete'));
    }
}
