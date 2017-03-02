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
    ]
];