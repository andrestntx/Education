<?php

namespace Education\Http\ViewComposers\GeneratedProtocols;

use Illuminate\Contracts\View\View;

class FormComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $questions = \Auth::user()->company->protocolGeneratorQuestions()
            ->with(['questions.questions.questions.questions.questions'])
            ->whereNull('superior_id')
            ->whereAviable(1)
            ->orderBy('order', 'asc')
            ->get();

        $view->with([
            'questions' => $questions,
        ]);
    }
}
