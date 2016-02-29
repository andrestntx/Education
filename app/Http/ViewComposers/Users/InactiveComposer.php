<?php

namespace Education\Http\ViewComposers\Users;

use Education\Entities\User;
use Illuminate\Contracts\View\View;

class InactiveComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $users = \Auth::user()->company->users()
            ->whereType('registered')
            ->whereActive(false)
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        
        $view->with([
            'users' => $users,
        ]);
    }
}
