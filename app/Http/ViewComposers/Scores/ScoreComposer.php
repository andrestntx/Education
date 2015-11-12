<?php namespace Education\Http\ViewComposers\Scores;

use Illuminate\Contracts\View\View;
use Auth;

class ScoreComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $protocolsPending   = Auth::user()->getExamProtocolsPending();
        $protocolsOk        = Auth::user()->getExamProtocolsOk();

        $user = Auth::user()->load(['company']);

        $view->with([
            'protocolsPending'  => $protocolsPending,
            'protocolsOk'       => $protocolsOk,
            'user'              => $user
        ]);
    }
 
}
