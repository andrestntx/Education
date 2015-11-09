<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell LaravelAppUi the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/***** Auth *****/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/** App **/
Route::group(['middleware' => ['auth'], 'namespace' => 'Dashboard'], function()
{
	Route::group(['middleware' => 'user_type:superadmin'], function()
	{
		Route::resource('companies', 'CompaniesController');
		Route::resource('companies.users', 'CompanyUsersController');
	});

	Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index']);	
});