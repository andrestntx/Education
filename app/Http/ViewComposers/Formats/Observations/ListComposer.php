<?php

namespace Education\Http\ViewComposers\Formats\Observations;

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
        $formats = Auth::user()->company->observationFormats()->orderBy('updated_at', 'desc')->paginate(20);
        
        $view->with([
            'formats' => $formats,
        ]);
    }
}
