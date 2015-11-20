<?php namespace Education\Http\Requests\Users;

use Education\Http\Requests\Request;
use Illuminate\Routing\Route;
use Auth;


class ProfileRequest extends Request {

	/**
	 * @var Route
	 */
	private $route;
	private $createRequest;

	public function __construct(Route $route) 
	{
		$this->route = $route;
		$this->createRequest = new CreateRequest;
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
        $rules = $this->createRequest->rules();
        $rules['username'] .= ',username,' . Auth::user()->id . ',id';
        $rules['password'] = 'confirmed';
        $rules['areas'] = '';
        $rules['roles'] = '';

		return $rules;
	}

}
