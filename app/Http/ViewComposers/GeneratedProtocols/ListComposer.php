<?php

namespace Education\Http\ViewComposers\GeneratedProtocols;

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
        $generatedProtocols = \Auth::user()->generatedProtocols()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'generatedProtocols' => $generatedProtocols,
        ]);
    }
}
