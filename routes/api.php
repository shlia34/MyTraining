<?php
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
    Route::get('/{id}', 'ProgramController@show')->name('program.show');
    Route::get('/links/{date}', 'ProgramController@links')->name('program.links');
    Route::get('/{date}/{code}', 'ProgramController@previous')->name('program.previous');
    Route::post('/', 'ProgramController@store')->name('program.store');
    Route::patch('/', 'ProgramController@updateDate')->name('program.updateDate');
    Route::delete('/{id}', 'ProgramController@delete')->name('program.delete');
});

//exercises
Route::group(['prefix' => 'exercises'],function (){
    Route::get('/routines/{muscle_code}', 'ExerciseController@routine')->name('exercises.routines');
    Route::get('/routines/{muscle_code}/selectBox', 'ExerciseController@selectBox')->name('exercises.selectBox');
    Route::get('/not_routines/{muscle_code}', 'ExerciseController@notRoutine')->name('exercises.not_routines');
    Route::get('/{id}', 'ExerciseController@show')->name('exercises.show');
    Route::post('/', 'ExerciseController@store')->name('exercise.store');
});

//Routine
Route::group(['prefix' => 'routines'],function (){
    Route::post('/', 'RoutineController@store')->name('routine.store');
    Route::delete('/{exercise_id}', 'RoutineController@delete')->name('routine.delete');
    Route::patch('/sort', 'RoutineController@sort')->name('routine.sort');
});

//workout
Route::group(['prefix' => 'workouts'], function () {
    //workout
    Route::post('/', 'WorkoutController@store')->name('workout.store');
    Route::delete('/{id}', 'WorkoutController@delete')->name('workout.delete');
    //is_max
    Route::group(['prefix' => 'max'],function () {
        Route::patch('/on', 'WorkoutController@OnMax')->name('workout.onMax');
        Route::patch('/off', 'WorkoutController@OffMax')->name('workout.offMax');
    });
});

Route::group(['prefix' => 'csv'],function (){
    Route::get('/index', 'CsvController@index')->name('csv.index');
});

Route::group(['prefix' => 'search'],function (){
    Route::get('/program', 'SearchController@program');
    Route::get('/exercise', 'SearchController@exercise');
    Route::get('/menu', 'SearchController@menu');
    Route::get('/workout', 'SearchController@workout');

});



