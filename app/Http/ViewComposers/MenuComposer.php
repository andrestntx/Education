<?php namespace LaravelAppUi\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use LaravelAppUi\Libraries\Campaing;

 
class MenuComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'template'  => 'default',
            'menu'      => []
        ]);
    }
 
}