<?php

namespace Education\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'template' => 'default',
            'menu' => [],
        ]);
    }
}
