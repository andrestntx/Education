<?php namespace Education\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Education\Libraries\Campaing;

 
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