<?php

use Vinkla\Vimeo\Facades\Vimeo;
use Education\Entities\Protocol;

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
        
        Route::group(['namespace' => 'Config'], function () {
            Route::resource('areas', 'AreasController');
            Route::resource('roles', 'RolesController');
            Route::resource('categories', 'CategoriesController');

            Route::get('users/inactive', ['as' => 'users.inactive', 'uses' => 'UsersController@inactive']);
            Route::post('users/{users}/activate', ['as' => 'users.activate', 'uses' => 'UsersController@activate']);
            Route::get('users/{users}/scores', ['as' => 'users.scores', 'uses' => 'UsersController@scores']);
            Route::resource('users', 'UsersController');
        });

        Route::group(['namespace' => 'Protocols'], function () {
            Route::resource('protocols', 'ProtocolsController');
            Route::resource('protocols.questions', 'ProtocolQuestionsController');
            Route::resource('protocols.links', 'ProtocolLinksController');
            Route::resource('protocols.videos', 'ProtocolVideosController');
            Route::resource('protocols.annexes', 'ProtocolAnnexesController');

            Route::group(['namespace' => 'Generator'], function () {
                Route::resource('generators', 'ProtocolGeneratorController');

                Route::resource('generators.questions', 'ProtocolGeneratorQuestionsController');
                Route::post('generators/{generators}/order', ['as' => 'generators.order', 'uses' => 'ProtocolGeneratorQuestionsController@order']);
                Route::post('generators/{generators}/change/{questions}', ['as' => 'generators.questions.change', 'uses' => 'ProtocolGeneratorQuestionsController@changeAviable']);
                Route::resource('generators.generated-protocols', 'GeneratedProtocolsController');
            });

        });
        
        Route::group(['prefix' => 'formats'], function () {

            Route::group(['namespace' => 'Checklists'], function () {
                Route::resource('checklists', 'FormatsController');
                Route::resource('checklists.questions', 'FormatQuestionsController');
                Route::post('checklists/{checklists}/order', ['as' => 'formats.order', 'uses' => 'FormatQuestionsController@order']);
            });

            Route::group(['namespace' => 'Observations'], function () {
                Route::resource('observations', 'FormatsController');
                Route::resource('observations.questions', 'FormatQuestionsController');
                Route::post('observations/{observations}/order', ['as' => 'formats.order', 'uses' => 'FormatQuestionsController@order']);
            });

        });

        Route::group(['namespace' => 'Maths'], function () {
            Route::resource('maths', 'MathsController');
        });
    });

    Route::group(['middleware' => 'user_type:registered'], function () {
        
        Route::group(['namespace' => 'Protocols'], function () {
            Route::post('{protocols}/forum', ['as' => 'protocols.forum.store', 'uses' => 'ProtocolForumsController@store']);
        });
        
        Route::get('study/{protocols}', ['as' => 'study', 'uses' => 'ExamsController@studyProtocol']);
        Route::get('exams/doit/{protocols}', ['as' => 'exams.create', 'uses' => 'ExamsController@create']);
        Route::post('exams/doit/{protocols}', ['as' => 'exams.store', 'uses' => 'ExamsController@store']);
        
        Route::group(['prefix' => 'myformats'], function () {
           
            Route::group(['namespace' => 'Checklists'], function () {
                Route::get('checklists', ['as' => 'myformats.checklists', 'uses' => 'ChecklistsController@allMyFormats']);
                Route::resource('checklists.doit', 'ChecklistsController', ['only' => ['index', 'create', 'store', 'show']]);
                Route::get('checklists/{checklists}/doit/{doit}/donwload', ['as' => 'myformats.checklists.doit.donwload', 'uses' => 'ChecklistsController@download']);
            });

            Route::group(['namespace' => 'Observations'], function () {
                Route::get('observations', ['as' => 'myformats.observations', 'uses' => 'ObservationsController@allMyFormats']);
                Route::resource('observations.doit', 'ObservationsController', ['only' => ['index', 'create', 'store', 'show']]);
                Route::get('observations/{observations}/doit/{doit}/donwload', ['as' => 'myformats.observations.doit.donwload', 'uses' => 'ObservationsController@download']);
            });

        });
    });

    Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index']);
    Route::put('profile', ['as' => 'profile', 'uses' => 'Config\UsersController@profile']);

});
