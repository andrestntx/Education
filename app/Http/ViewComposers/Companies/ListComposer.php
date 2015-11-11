<?php namespace App\Http\ViewComposers\Companies;

use Illuminate\Contracts\View\View;
use App\Entities\Company;
 
class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $companies = Company::whereType('customer')->orderBy('id')->paginate(10);

        $view->with([
            'companies' => $companies
        ]);
    }
 
}
