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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'TopController@index');
Route::get('/event/{event_id}', 'EventController@show');


Route::post('/ajax/setEvents', 'AjaxEventController@setEvents');
Route::post('/ajax/addEvent', 'AjaxEventController@addEvent');
Route::post('/ajax/editEventDate', 'AjaxEventController@editEventDate');
Route::post('/ajax/showEventsByDate', 'AjaxEventController@showEventsByDate');


Route::post('/ajax/storeTraining', 'AjaxTrainingController@storeTraining');