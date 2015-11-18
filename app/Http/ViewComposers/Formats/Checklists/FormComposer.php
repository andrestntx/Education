<?php namespace Education\Http\ViewComposers\Formats\Checklists;

use Illuminate\Contracts\View\View;
use Education\Entities\Category;
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
    	$roles 		= Auth::user()->company->roles->lists('name', 'id')->all();
		$areas 		= Auth::user()->company->areas->lists('name', 'id')->all();		

        $view->with([
            'roles' 		=> $roles,
            'areas' 		=> $areas            
        ]);
    }
 
}

		