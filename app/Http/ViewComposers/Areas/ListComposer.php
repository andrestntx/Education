<?php

namespace Education\Http\ViewComposers\Areas;

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
        $areas = \Auth::user()->company->areas()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'areas' => $areas,
        ]);
    }
}
