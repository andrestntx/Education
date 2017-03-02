<?php

namespace Education\Http\Requests\Companies;

use Education\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request
{
    /**
     * @var Route
     */
    private $route;
    private $createRequest;

    public function __construct(Route $route)
    {
        $this->route = $route;
        $this->createRequest = new CreateRequest();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $company = $this->route->getParameter('companies');
        $rules = $this->createRequest->rules();
        $rules['name'] .= ',name,'.$company->id.',id';

        return $rules;
    }
}
