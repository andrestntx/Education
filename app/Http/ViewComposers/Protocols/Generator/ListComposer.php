<?php

namespace Education\Http\ViewComposers\Protocols\Generator;

use Illuminate\Contracts\View\View;
use Auth;

class ListComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $company = Auth::user()->company->load([
            'protocolGeneratorQuestions' => function($query){
                $query->orderBy('order');
            }
        ]);

        $view->with([
            'company' => $company,
        ]);
    }
}
