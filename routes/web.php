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
        //program
        Route::get('/', 'ProgramController@index')->name('program.index');
        Route::get('/programs/{program_id}', 'ProgramController@show')->name('program.show');
        Route::get('/programs/{program_id}/destroy', 'ProgramController@destroy')->name('program.destroy');
        //exrcise
        Route::group(['prefix' => 'exercises'],function (){
            Route::get('/index', 'ExerciseController@index')->name('exercise.index');
            Route::get('/create', 'ExerciseController@create')->name('exercise.create');
            Route::post('/store', 'ExerciseController@store')->name('exercise.store');
            Route::get('/{exercise_id}', 'ExerciseController@show')->name('exercise.show');
        });
        //csv
        Route::group(['prefix' => 'csv'],function (){
            Route::get('/index', 'CsvController@index')->name('csv.index');
            Route::get('/export/{modelName}', 'CsvController@export')->name('csv.export');
            Route::post('/import', 'CsvController@import')->name('csv.import');
        });

    });
    //api
    Route::group(['namespace' => 'Api','prefix' => 'api'], function () {
        //program api
        Route::group(['prefix' => 'programs'], function () {
            Route::get('/set', 'ProgramController@set')->name('program.set');
            Route::post('/showLinks', 'ProgramController@showLinks')->name('program.showLinks');
            Route::post('/store', 'ProgramController@store')->name('program.store');
            Route::post('/updateDate', 'ProgramController@updateDate')->name('programUpdateDate');
        });
        //workout api
        Route::group(['prefix' => 'workouts'], function () {
            //workout
            Route::post('/store', 'WorkoutController@store')->name('workout.store');
            Route::post('/destroy', 'WorkoutController@destroy')->name('workout.destroy');
            //is_max
            Route::group(['prefix' => 'max'],function () {
                Route::post('/on', 'WorkoutController@OnMax')->name('workout.onMax');
                Route::post('/off', 'WorkoutController@OffMax')->name('workout.offMax');
                Route::post('/check', 'WorkoutController@checkMax')->name('workout.checkMax');
            });
        });
        //Routine api
        Route::group(['prefix' => 'routines'],function (){
            Route::post('/store', 'RoutineController@store')->name('routine.store');
            Route::post('/destroy', 'RoutineController@destroy')->name('routine.destroy');
            Route::post('/sort', 'RoutineController@sort')->name('routine.sort');
        });

    });

});









