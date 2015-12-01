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
            'Education\Http\ViewComposers\Categories\ListComposer' => 'dashboard.pages.companies.users.categories.list',
            'Education\Http\ViewComposers\Protocols\ListComposer' => 'dashboard.pages.companies.users.protocols.list',
            'Education\Http\ViewComposers\Protocols\FormComposer' => 'dashboard.pages.companies.users.protocols.form',
            'Education\Http\ViewComposers\Users\ListComposer' => 'dashboard.pages.companies.users.admin.list',
            'Education\Http\ViewComposers\Users\FormComposer' => 'dashboard.pages.companies.users.admin.form',
            'Education\Http\ViewComposers\Formats\ListComposer' => 'dashboard.pages.companies.users.formats.list',
            'Education\Http\ViewComposers\Formats\FormComposer' => 'dashboard.pages.companies.users.formats.form',
            'Education\Http\ViewComposers\Formats\MyFormatsComposer' => 'dashboard.pages.companies.users.formats.myformats',
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
