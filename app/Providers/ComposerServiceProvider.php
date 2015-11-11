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
            'Education\Http\ViewComposers\Categories\ListComposer'      => 'dashboard.pages.categoies.lists-table',
            'Education\Http\ViewComposers\Companies\ListComposer'       => 'dashboard.pages.companies.list'
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
