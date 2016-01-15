<?php

namespace Education\Http\ViewComposers\Maths;

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
        $maths = \Auth::user()->company->maths()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'maths' => $maths,
        ]);
    }
}
