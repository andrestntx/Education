<?php namespace Education\Http\Requests\Users;

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
        //dd($this->all());
		return [
            'username'     	=> 'required|max:100|unique:users',
            'name'     		=> 'required',
            'email'     	=> 'email|required|max:100',
            'password' 		=> 'required|confirmed',
            'url_photo' 	=> 'mimes:jpeg,png,bmp|max:1500',
            'roles_'         => 'required|array',
            'areas_'         => 'required|array'
		];
	}
}