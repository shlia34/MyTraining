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
    //web
    Route::group(['namespace' => 'Web'],function(){
        //event
        Route::get('/', 'EventController@index');
        Route::get('/event/{event_id}', 'EventController@show');
        Route::get('/event/{event_id}/destroy', 'EventController@destroy');
        //stage
        Route::group(['prefix' => 'stages'],function (){
            Route::get('/index', 'StageController@index');
            Route::get('/{stage_id}', 'StageController@show');
            Route::get('/create', 'StageController@create');
            Route::post('/store', 'StageController@store');
            //Route::get('/stage/{stage_id}/edit', 'StageController@edit');
            //Route::post('/stage/update', 'StageController@update');
        });
        //csv
        Route::group(['prefix' => 'csv'],function (){
            Route::get('/index', 'CsvController@index');
            Route::get('/export/{modelName}', 'CsvController@export');
            Route::post('/import', 'CsvController@import');
        });

    });
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
            //training
            Route::post('/store', 'TrainingController@store');
            Route::post('/destroy', 'TrainingController@destroy');
            //is_max
            Route::group(['prefix' => 'max'],function () {
                Route::post('/on', 'TrainingController@OnMax');
                Route::post('/off', 'TrainingController@OffMax');
                Route::post('/check', 'TrainingController@checkMax');
            });
        });
        //choice api
        Route::group(['prefix' => 'choices'],function (){
            Route::post('/store', 'ChoiceController@store');
            Route::post('/destroy', 'ChoiceController@destroy');
        });

    });

});









