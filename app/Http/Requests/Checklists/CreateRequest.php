<?php namespace Education\Http\Requests\Checklists;

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
            'applied'          => 'required|max:100',
            'observation'      => 'max:254',
		];
	}
}