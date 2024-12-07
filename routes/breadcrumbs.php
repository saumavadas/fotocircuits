<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Mosdels\Role;
use Spatie\Permission\Models\Users;

Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('admin.index'));
});
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.users.index');
    $trail->push('Add new user', route('admin.users.create'));
});

// Role
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Roles', route('admin.roles.index'));
});
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.roles.index');

    $trail->push('Add new role', route('admin.roles.create'));
});
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $post): void {
    $trail->parent('admin.roles.index');

    $trail->push($post->name, route('admin.roles.edit', $post));
});
// Permission
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Permissions', route('admin.permissions.index'));
});
Breadcrumbs::for('admin.permissions.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.permissions.index');

    $trail->push('Add new permission', route('admin.permissions.create'));
});
Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbTrail $trail, Permission $post): void {
    $trail->parent('admin.permissions.index');

    $trail->push($post->name, route('admin.permissions.edit', $post));
});
// profile
Breadcrumbs::for('admin.profile.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Profile', route('admin.profile.index'));
});
// change password
Breadcrumbs::for('admin.password.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Change Password', route('admin.password.index'));
});


Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Categories', route('admin.categories.index'));
});


Breadcrumbs::for('admin.categories.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.categories.index');
    $trail->push('Category add', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Category edit', route('admin.categories.edit'));
});

Breadcrumbs::for('admin.media.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Media Manager', route('admin.media.index'));
});
Breadcrumbs::for('admin.media.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.media.index');
    $trail->push('Media Manager', route('admin.media.create'));
});

Breadcrumbs::for('admin.sellers.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Sellers', route('admin.sellers.index'));
});

Breadcrumbs::for('admin.customers.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Customers', route('admin.customers.index'));
});
