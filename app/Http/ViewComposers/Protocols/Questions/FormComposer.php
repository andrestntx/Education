<?php namespace Education\Http\ViewComposers\Protocols\Questions;

use Illuminate\Contracts\View\View;
use Auth;
 
class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
    	
        $view->with([
            
        ]);
    }
 
}

		