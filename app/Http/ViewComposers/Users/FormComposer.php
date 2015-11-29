<?php

namespace Education\Http\ViewComposers\Users;

use Illuminate\Contracts\View\View;
use Education\Entities\User;

class FormComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $roles = \Auth::user()->company->roles->lists('name', 'id')->all();
        $areas = \Auth::user()->company->areas->lists('name', 'id')->all();
        $view->with([
            'roles' => $roles,
            'areas' => $areas,
        ]);
    }
}
