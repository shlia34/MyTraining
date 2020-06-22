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

    Route::group(['prefix' => 'csv'],function (){
        Route::get('/index', 'Web\CsvController@index')->name('csv.index');
        Route::get('/export/{modelName}', 'Web\CsvController@export')->name('csv.export');
        Route::post('/import', 'Web\CsvController@import')->name('csv.import');
    });

    Route::get('/{any}', function () {
        return view('spa');
    })->where('any', '.*');


});









