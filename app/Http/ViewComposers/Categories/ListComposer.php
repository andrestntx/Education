<?php namespace Education\Http\ViewComposers\Categories;

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
        $categories = \Auth::user()->company->categories()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'categories' => $categories
        ]);
    }
 
}
