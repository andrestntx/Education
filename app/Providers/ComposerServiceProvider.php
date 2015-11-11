<?php namespace Education\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'Education\Http\ViewComposers\MenuComposer'                 => ['auth.login',
                                                                        'dashboard.pages.*'],
            'Education\Http\ViewComposers\Companies\ListComposer'       => 'dashboard.pages.companies.list',
            'Education\Http\ViewComposers\Areas\ListComposer'           => 'dashboard.pages.companies.users.areas.list',
            'Education\Http\ViewComposers\Roles\ListComposer'           => 'dashboard.pages.companies.users.roles.list',
            'Education\Http\ViewComposers\Categories\ListComposer'      => 'dashboard.pages.companies.users.categories.list',
            'Education\Http\ViewComposers\Protocols\ListComposer'       => 'dashboard.pages.companies.users.protocols.list',
            'Education\Http\ViewComposers\Protocols\FormComposer'       => 'dashboard.pages.companies.users.protocols.form'
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
