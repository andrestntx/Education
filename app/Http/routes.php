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

/* App **/
Route::group(['middleware' => ['auth'], 'namespace' => 'Dashboard'], function () {
    Route::group(['middleware' => 'user_type:superadmin'], function () {
        Route::resource('companies', 'CompaniesController');
        Route::resource('companies.users', 'CompanyUsersController');
    });

    Route::group(['middleware' => 'user_type:admin'], function () {
        Route::resource('areas', 'AreasController');
        Route::resource('roles', 'RolesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('users', 'UsersController');
        Route::get('users/{users}/scores', ['as' => 'users.scores', 'uses' => 'UsersController@scores']);

        Route::resource('protocols', 'ProtocolsController');
        Route::resource('protocols.questions', 'ProtocolQuestionsController');
        Route::resource('protocols.links', 'ProtocolLinksController');
        Route::resource('protocols.annexes', 'ProtocolAnnexesController');

        Route::resource('protocol-generator', 'ProtocolGeneratorQuestionsController');
        Route::post('protocol-generator/order', ['as' => 'protocol-generator.order', 'uses' => 'ProtocolGeneratorQuestionsController@order']);
        Route::resource('generated-protocols', 'GeneratedProtocolsController');
        
        Route::group(['namespace' => 'FormatsChecklists'], function () {
            Route::resource('formats', 'FormatsController');
            Route::resource('formats.questions', 'FormatQuestionsController');
            Route::post('formats/{formats}/order', ['as' => 'formats.order', 'uses' => 'FormatQuestionsController@order']);
        });

        /*Route::get('protocols/{protocol}/stats', array('as' => 'protocols.stats', 'uses' => 'ProtocolsController@stats'));*/
    });

    Route::group(['middleware' => 'user_type:registered'], function () {
        Route::get('study/{protocols}', ['as' => 'study', 'uses' => 'ExamsController@studyProtocol']);
        Route::get('exams/doit/{protocols}', ['as' => 'exams.create', 'uses' => 'ExamsController@create']);
        Route::post('exams/doit/{protocols}', ['as' => 'exams.store', 'uses' => 'ExamsController@store']);

        Route::group(['namespace' => 'Checklists'], function () {
            Route::get('myformats', ['as' => 'myformats', 'uses' => 'MyFormatChecklistsController@allMyFormats']);
            Route::resource('myformats.checklists', 'MyFormatChecklistsController', ['only' => ['index', 'create', 'store', 'show']]);
            Route::get('myformats/{myformats}/checklists/{checklists}/donwload', ['as' => 'myformats.checklists.donwload', 'uses' => 'MyFormatChecklistsController@download']);
        });
    });

    Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index']);
    Route::put('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
});
