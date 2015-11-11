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

            'Education\Http\ViewComposers\CategoriesComposer'        => 'dashboard.pages.category.lists-table',
            'Education\Http\ViewComposers\Areas\ListComposer'        => 'dashboard.pages.area.list',
            'Education\Http\ViewComposers\Roles\ListComposer'        => 'dashboard.pages.user.role.list',
            'Education\Http\ViewComposers\Categories\ListComposer'      => 'dashboard.pages.category.lists-table',
            'Education\Http\ViewComposers\Companies\ListComposer'       => 'dashboard.pages.company.list'

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
