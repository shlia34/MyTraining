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
        //exercise
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

});









