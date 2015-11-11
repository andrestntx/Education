<?php namespace App\Http\ViewComposers\Categories;

use Illuminate\Contracts\View\View;
use App\Entities\Category;
 
class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $categories = Category::paginate(20);

        $view->with([
            'categories' => $categories
        ]);
    }
 
}
