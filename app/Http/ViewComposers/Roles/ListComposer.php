<?php

namespace Education\Http\ViewComposers\Roles;

use Illuminate\Contracts\View\View;

class ListComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $roles = \Auth::user()->company->roles()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'roles' => $roles,
        ]);
    }
}
