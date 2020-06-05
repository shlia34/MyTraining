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
        Route::get('/', 'ProgramController@index');
        Route::get('/events/{event_id}', 'ProgramController@show');
        Route::get('/events/{event_id}/destroy', 'ProgramController@destroy');
        //stage
        Route::group(['prefix' => 'stages'],function (){
            Route::get('/index', 'ExerciseController@index');
            Route::get('/create', 'ExerciseController@create');
            Route::post('/store', 'ExerciseController@store');
            Route::get('/{stage_id}', 'ExerciseController@show');
            //Route::get('/stage/{stage_id}/edit', 'ExerciseController@edit');
            //Route::post('/stage/update', 'ExerciseController@update');
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
        //program api
        Route::group(['prefix' => 'events'], function () {
            Route::get('/set', 'ProgramController@set');
            Route::post('/showLinks', 'ProgramController@showLinks');
            Route::post('/store', 'ProgramController@store');
            Route::post('/updateDate', 'ProgramController@updateDate');
        });
        //workout api
        Route::group(['prefix' => 'trainings'], function () {
            //workout
            Route::post('/store', 'WorkoutController@store');
            Route::post('/destroy', 'WorkoutController@destroy');
            //is_max
            Route::group(['prefix' => 'max'],function () {
                Route::post('/on', 'WorkoutController@OnMax');
                Route::post('/off', 'WorkoutController@OffMax');
                Route::post('/check', 'WorkoutController@checkMax');
            });
        });
        //Routine api
        Route::group(['prefix' => 'choices'],function (){
            Route::post('/store', 'RoutineController@store');
            Route::post('/destroy', 'RoutineController@destroy');
            Route::post('/sort', 'RoutineController@sort');
        });

    });

});









