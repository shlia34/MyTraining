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
//イベント一覧と詳細
Route::get('/', 'TopController@index');
Route::get('/event/{event_id}', 'TopController@show');
//イベントのいろいろ
Route::get('/setEvents', 'EventController@setEvents');
Route::get('/event/delete/{event_id}', 'EventController@delete');
Route::post('/ajax/addEvent', 'EventController@addEvent');
Route::post('/ajax/editEventDate', 'EventController@editEventDate');
Route::post('/ajax/showEventsByDate', 'EventController@showEventsByDate');
//トレーニング関連
Route::post('/ajax/storeTraining', 'TrainingController@storeTraining');
Route::post('/ajax/deleteTraining', 'TrainingController@deleteTraining');
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


