<?php

namespace Education\Http\ViewComposers\Protocols;

use Illuminate\Contracts\View\View;
use Auth;

class FormComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $roles = Auth::user()->company->roles->lists('name', 'id')->all();
        $areas = Auth::user()->company->areas->lists('name', 'id')->all();
        $categories = Auth::user()->company->categories->lists('name', 'id')->all();

        $view->with([
            'roles' => $roles,
            'areas' => $areas,
            'categories' => $categories,
        ]);
    }
}
