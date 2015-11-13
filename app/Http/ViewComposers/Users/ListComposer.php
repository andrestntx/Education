<?php namespace Education\Http\ViewComposers\Users;

use Education\Entities\User;
use Illuminate\Contracts\View\View;

class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $users = \Auth::user()->company->users()->whereType('registered')->orderBy('updated_at','DESC')->paginate(20);
        $view->with([
            'users' => $users
        ]);
    }
 
}
