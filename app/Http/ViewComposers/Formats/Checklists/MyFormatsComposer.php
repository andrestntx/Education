<?php

namespace Education\Http\ViewComposers\Formats\Checklists;

use Illuminate\Contracts\View\View;
use Auth;

class MyFormatsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $formats = Auth::user()->formats()->paginate(20);
        $user = Auth::user()->load(['company']);

        $view->with([
            'formats' => $formats,
            'user' => $user,
        ]);
    }
}
