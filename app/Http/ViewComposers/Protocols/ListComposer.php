<?php namespace Education\Http\ViewComposers\Protocols;

use Illuminate\Contracts\View\View;
use Education\Entities\Category;
 
class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $protocols = \Auth::user()->company->protocols()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'protocols' => $protocols
        ]);
    }
 
}
