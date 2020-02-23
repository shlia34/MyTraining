<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //event
    Route::get('/', 'EventController@index');
    Route::get('/event/{event_id}', 'EventController@show');
    Route::get('/event/{event_id}/destroy', 'EventController@destroy');
    //api
    Route::group(['namespace' => 'Api','prefix' => 'api'], function () {
        //event api
        Route::group(['prefix' => 'events'], function () {
            Route::get('/set', 'EventController@set');
            Route::post('/showLinks', 'EventController@showLinks');
            Route::post('/store', 'EventController@store');
            Route::post('/updateDate', 'EventController@updateDate');
        });
        //training api
        Route::group(['prefix' => 'trainings'], function () {
            Route::post('store', 'TrainingController@store');
            Route::post('destroy', 'TrainingController@destroy');
        });
    });
    //is_max
    Route::post('/ajax/recordMaxTraining', 'TrainingController@recordMaxTraining');
    Route::post('/ajax/checkMaxTraining', 'TrainingController@checkMaxTraining');
    Route::post('/ajax/deleteMaxTraining', 'TrainingController@deleteMaxTraining');
//csv関連
    Route::get('/csv/index', 'AdminController@csv');
    Route::get('/csv/export/{modelName}', 'Csv\ExportController');
    Route::post('/csv/import', 'Csv\ImportController');
//種目関連
    Route::get('/stage/index', 'StageController@index');
    Route::get('/stage/create', 'StageController@create');
    Route::get('/stage/{stage_id}', 'StageController@show');
    Route::post('/stage/store', 'StageController@store');
    Route::get('/stage/edit/{stage_id}', 'StageController@edit');
    Route::post('/stage/update', 'StageController@update');
//ユーザーの種目リスト
    Route::post('/ajax/stage_user/store', 'UserStageController@store');
    Route::post('/ajax/stage_user/delete', 'UserStageController@delete');



});









