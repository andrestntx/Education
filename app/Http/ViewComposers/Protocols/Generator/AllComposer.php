<?php

namespace Education\Http\ViewComposers\Protocols\Generator;

use Illuminate\Contracts\View\View;
use Auth;

class AllComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $company = Auth::user()->company->load([
            'generators'
        ]);

        $view->with([
            'company' => $company,
        ]);
    }
}
