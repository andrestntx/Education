<?php namespace Education\Http\ViewComposers\Formats\Users;

use Illuminate\Contracts\View\View;
use Education\Entities\Category;
use Auth;

class ShowComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $formats = Auth::user()->formats()->paginate(20);
        $user = Auth::user()->load(['company']);

        $view->with([
            'formats' => $formats,
            'user'    => $user
        ]);
    }
 
}
