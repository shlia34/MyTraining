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

Route::get('/', 'TopController@index');
Route::get('/event/{event_id}', 'TopController@show');

Route::get('/setting', 'TopController@setting');
Route::get('/csv/event/download', 'CsvController@eventDownload');
Route::get('/csv/training/download', 'CsvController@trainingDownload');
Route::post('/csv/event/import', 'EventController@importCsv');


Route::get('/setEvents', 'EventController@setEvents');
Route::get('/event/delete/{event_id}', 'EventController@delete');
Route::post('/ajax/addEvent', 'EventController@addEvent');
Route::post('/ajax/editEventDate', 'EventController@editEventDate');
Route::post('/ajax/showEventsByDate', 'EventController@showEventsByDate');

Route::post('/ajax/storeTraining', 'TrainingController@storeTraining');
Route::post('/ajax/deleteTraining', 'TrainingController@deleteTraining');
Route::post('/ajax/recordMaxTraining', 'TrainingController@recordMaxTraining');
Route::post('/ajax/checkMaxTraining', 'TrainingController@checkMaxTraining');
Route::post('/ajax/deleteMaxTraining', 'TrainingController@deleteMaxTraining');