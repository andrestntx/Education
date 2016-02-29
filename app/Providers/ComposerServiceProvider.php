<?php

namespace Education\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        View::composers([
            'Education\Http\ViewComposers\MenuComposer' => ['auth.login',
                                                                            'dashboard.pages.*', ],
            'Education\Http\ViewComposers\Companies\ListComposer' => 'dashboard.pages.companies.list',
            'Education\Http\ViewComposers\Areas\ListComposer' => 'dashboard.pages.companies.users.areas.list',
            'Education\Http\ViewComposers\Roles\ListComposer' => 'dashboard.pages.companies.users.roles.list',
            'Education\Http\ViewComposers\Maths\ListComposer' => 'dashboard.pages.companies.users.maths.list',
            'Education\Http\ViewComposers\Categories\ListComposer' => 'dashboard.pages.companies.users.categories.list',
            'Education\Http\ViewComposers\Protocols\ListComposer' => 'dashboard.pages.companies.users.protocols.list',
            'Education\Http\ViewComposers\Protocols\FormComposer' => 'dashboard.pages.companies.users.protocols.form',
            'Education\Http\ViewComposers\Users\ListComposer' => 'dashboard.pages.companies.users.admin.list',
            'Education\Http\ViewComposers\Users\InactiveComposer' => 'dashboard.pages.companies.users.admin.inactive',
            'Education\Http\ViewComposers\Users\FormComposer' => 'dashboard.pages.companies.users.admin.form',
            'Education\Http\ViewComposers\Formats\Checklists\ListComposer' => 'dashboard.pages.companies.users.formats.checklists.format.list',
            'Education\Http\ViewComposers\Formats\Observations\ListComposer' => 'dashboard.pages.companies.users.formats.observations.format.list',
            'Education\Http\ViewComposers\Formats\FormComposer' => 'dashboard.pages.companies.users.formats.*.format.form',
            'Education\Http\ViewComposers\Formats\Checklists\MyFormatsComposer' => 'dashboard.pages.companies.users.formats.checklists.format.myformats',
            'Education\Http\ViewComposers\Formats\Observations\MyFormatsComposer' => 'dashboard.pages.companies.users.formats.observations.format.myformats',
            'Education\Http\ViewComposers\Protocols\Generator\ListComposer' => 'dashboard.pages.companies.users.protocols.generator.config',
            'Education\Http\ViewComposers\GeneratedProtocols\ListComposer' => 'dashboard.pages.companies.users.protocols.generator.list',
            'Education\Http\ViewComposers\GeneratedProtocols\FormComposer' => 'dashboard.pages.companies.users.protocols.generator.form'
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
