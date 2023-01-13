<?php
use  \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home Admin
Breadcrumbs::for('main', function ($trail) {
    $trail->push(__('Main'), route('main'));
});

// Home Site
Breadcrumbs::for('site', function ($trail) {
    $trail->push(__('Main'), route('services.contact'));
});

define('BREADCRUMB_HOME', auth()->check() ? 'main' : 'site');

// USERS ------------------------------------------------

// Home > Services
Breadcrumbs::for('services.index', function ($trail) {
    if (auth()->check()) {
        $trail->parent(BREADCRUMB_HOME);
        $trail->push(__('List of services'), route('services.index'));
    }
    elseif(request()->get('utype') == 'j' || request()->routeIs('*account*')) {
        $trail->push(__('Main'), route('services.account'));
        $trail->push(__('List of services'), route('services.account.all'));
    }
    else {
        $trail->push(__('Main'), route('services.contact'));
        $trail->push(__('List of services'), route('services.contact.all'));
    }
});
// Home > Services -> Detail
Breadcrumbs::for('services.detail', function ($trail, $service) {
    $trail->parent('services.index');
    $trail->push(trans($service->name), route('services.detail', $service->id));
});
Breadcrumbs::for('services.create', function ($trail, $service) {
    $trail->parent('services.detail', $service);
    $trail->push($service->id, route('services.create', $service->id));
});

// APPLICATIONS -----------------------------------------

// Home > Applications
Breadcrumbs::for('applications.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Applications'), route('applications.index'));
});

// USERS ------------------------------------------------

// Home > Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Users'), route('users.index'));
});
// Home > Users -> Add
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push(__('Add'), route('users.create'));
});
// Home > Users -> Show
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push("$user->last_name $user->first_name $user->middle_name", route('users.show', $user->id));
});
// Home > Users -> Show -> Edit
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push(__('Edit'), route('users.edit', $user->id));
});

// ROLES ------------------------------------------------

// Home > Roles
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Roles'), route('roles.index'));
});
// Home > Roles -> Add
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push(__('Add'), route('roles.create'));
});
// Home > Roles -> Show
Breadcrumbs::for('roles.show', function ($trail, $role) {
    $trail->parent('roles.index');
    $trail->push(__($role->name), route('roles.show', $role->id));
});
// Home > Roles -> Show -> Edit
Breadcrumbs::for('roles.edit', function ($trail, $role) {
    $trail->parent('roles.show', $role);
    $trail->push(__('Edit'), route('roles.edit', $role->id));
});

// PERMISSIONS ------------------------------------------------

// Home > Permissions
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Permissions'), route('permissions.index'));
});
// Home > Permissions -> Add
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push(__('Add'), route('permissions.create'));
});
// Home > Permissions -> Show
Breadcrumbs::for('permissions.show', function ($trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push(__($permission->name), route('permissions.show', $permission->id));
});
// Home > Permissions -> Show -> Edit
Breadcrumbs::for('permissions.edit', function ($trail, $permission) {
    $trail->parent('permissions.show', $permission);
    $trail->push(__('Edit'), route('permissions.edit', $permission->id));
});

// POSTS ------------------------------------------------

// Home > Posts
Breadcrumbs::for('posts.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Posts'), route('posts.index'));
});
// Home > Posts -> Add
Breadcrumbs::for('posts.create', function ($trail) {
    $trail->parent('posts.index');
    $trail->push(__('Add'), route('posts.create'));
});
// Home > Posts -> Show
Breadcrumbs::for('posts.show', function ($trail, $post) {
    $trail->parent('posts.index');
    $trail->push(__($post->title), route('posts.show', $post->id));
});
// Home > Posts -> Show -> Edit
Breadcrumbs::for('posts.edit', function ($trail, $post) {
    $trail->parent('posts.show', $post);
    $trail->push(__('Edit'), route('posts.edit', $post->id));
});
// Home > Posts -> Page
Breadcrumbs::for('posts.page', function ($trail, $post) {
    $trail->parent(BREADCRUMB_HOME);
    if (preg_match_all('/>([^><]{3,}?)</uim', $post->description, $matches)) {
        $trail->push($matches[1][0], route('posts.page', $post->id));
    }
});

// NEWS ------------------------------------------------

// Home > News
Breadcrumbs::for('news.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('All news'), route('news.index'));
});
// Home > News
Breadcrumbs::for('news.all', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('All news'), route('news.all'));
});
// Home > News -> Add
Breadcrumbs::for('news.create', function ($trail) {
    $trail->parent('news.index');
    $trail->push(__('Add'), route('news.create'));
});
// Home > News -> Show
Breadcrumbs::for('news.show', function ($trail, $article) {
    if (auth()->check())
        $trail->parent('news.index');
    else
        $trail->parent('news.all');
    $trail->push(__($article->title), route('news.show', $article->id));
});
// Home > News -> Show -> Edit
Breadcrumbs::for('news.edit', function ($trail, $article) {
    $trail->parent('news.show', $article);
    $trail->push(__('Edit'), route('news.edit', $article->id));
});

// OTHER SETTINGS ------------------------------------------------

// Home > Other settings
Breadcrumbs::for('others.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Other settings'), route('others.index'));
});
// Home > Other settings -> Add
Breadcrumbs::for('others.create', function ($trail) {
    $trail->parent('others.index');
    $trail->push(__('Add'), route('others.create'));
});
// Home > Other settings -> Show
Breadcrumbs::for('others.show', function ($trail, $other) {
    $trail->parent('others.index');
    $trail->push(__($other->title), route('others.show', $other->id));
});
// Home > Other settings -> Show -> Edit
Breadcrumbs::for('others.edit', function ($trail, $other) {
    $trail->parent('others.show', $other);
    $trail->push(__('Edit'), route('others.edit', $other->id));
});

// FILE MANAGER ------------------------------------------------

// Home > File manager
Breadcrumbs::for('files', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('File manager'), route('files'));
});

Breadcrumbs::for('warehouse_data', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Warehouse register'), route('warehouse_data'));
});

Breadcrumbs::for('certificates_data', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Registers of certificates'), route('certificates_data'));
});

Breadcrumbs::for('aboutPage', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('About project'), route('about'));
});

Breadcrumbs::for('classWarehouse', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Classes of commodity warehouse'), route('classWarehouse'));
});


// LOGS ------------------------------------------------
// Home > logs
Breadcrumbs::for('logs.index', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('All logs'), route('others.index'));
});
Breadcrumbs::for('logs.show', function ($trail, $log) {
    $trail->parent('logs.index');
    $trail->push(__($log->id), route('logs.show', $log->id));
});

// LANGUAGES ---------------------------------------------------

// Home > Languages
Breadcrumbs::for('lang', function ($trail) {
    $trail->parent(BREADCRUMB_HOME);
    $trail->push(__('Languages'), route('languages'));
});
