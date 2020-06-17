<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//program
Route::group(['prefix' => 'programs'], function () {
    Route::get('/set', 'ProgramController@set')->name('program.set');
    Route::post('/show', 'ProgramController@show')->name('program.show');
    Route::post('/showLinks', 'ProgramController@showLinks')->name('program.showLinks');
    Route::post('/store', 'ProgramController@store')->name('program.store');
    Route::post('/updateDate', 'ProgramController@updateDate')->name('program.updateDate');
    Route::post('/destroy', 'ProgramController@destroy')->name('program.destroy');
});
//workout
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
//Routine
Route::group(['prefix' => 'routines'],function (){
    Route::post('/store', 'RoutineController@store')->name('routine.store');
    Route::post('/destroy', 'RoutineController@destroy')->name('routine.destroy');
    Route::post('/sort', 'RoutineController@sort')->name('routine.sort');
});

//Routine
Route::group(['prefix' => 'exercises'],function (){
    Route::post('/index/routine', 'ExerciseController@indexRoutine')->name('exercises.indexRoutine');
});



