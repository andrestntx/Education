<?php

return [
    \Education\Entities\Protocol::class => [
        'route' => 'protocols',
        'view' => 'dashboard.pages.companies.users.protocols'
    ],
    \Education\Entities\Company::class => [
        'route' => 'companies',
        'view' => 'dashboard.pages.companies'
    ],
    \Education\Entities\User::class => [
        'route' => 'companies.users',
        'view' => 'dashboard.pages.companies.users.superadmin'
    ],
    \Education\Entities\Area::class => [
        'route' => 'areas',
        'view' => 'dashboard.pages.companies.users.areas'
    ],
    \Education\Entities\Category::class => [
        'route' => 'categories',
        'view' => 'dashboard.pages.companies.users.categories'
    ],
    \Education\Entities\Role::class => [
        'route' => 'roles',
        'view' => 'dashboard.pages.companies.users.roles'
    ],
    \Education\Entities\User::class => [
        'route' => 'users',
        'view' => 'dashboard.pages.companies.users.admin'
    ],
    \Education\Entities\Math::class => [
        'route' => 'maths',
        'view' => 'dashboard.pages.companies.users.maths'
    ],
    \Education\Entities\Format::class => [
        'route' => 'formats.observations',
        'view' => 'dashboard.pages.companies.users.formats.observations.format'
    ],
    \Education\Entities\Question::class => [
        'route' => 'formats.observations.questions',
        'view' => 'dashboard.pages.companies.users.formats.observations.questions'
    ]
];