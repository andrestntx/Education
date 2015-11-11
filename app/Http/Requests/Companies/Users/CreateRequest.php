<?php namespace Education\Http\Requests\Companies\Users;

use Education\Http\Requests\Request;

class CreateRequest extends Request {
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
			'name'	        => 'max:100|required',
			'username'		=> 'required|unique:users',
            'email'			=> 'max:100|required|unique:users',
        	'password'		=> 'confirmed|required',
        	'url_photo'		=> 'max:255'
		];
	}
}