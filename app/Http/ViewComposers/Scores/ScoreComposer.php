<?php namespace Education\Http\ViewComposers\Scores;


use Illuminate\Contracts\View\View;

class ScoreComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $protocols = \Auth::user()->protocols()->orderBy('updated_at', 'desc')->paginate(20);
        $user = \Auth::user()->load(['company']);

        $view->with([
            'protocols' => $protocols,
            'user'      => $user,
        ]);
    }
 
}
