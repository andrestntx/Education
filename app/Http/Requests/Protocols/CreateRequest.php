<?php

namespace Education\Http\Requests\Protocols;

use Education\Http\Requests\Request;

class CreateRequest extends Request
{
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
        return [
            'name' => 'max:100|required',
            'description' => 'max:200',
            'roles' => 'required|array',
            'areas' => 'required|array',
            'categories' => 'required|array',

        ];
    }
}
