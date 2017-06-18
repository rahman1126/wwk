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

Route::get('/', 'PublicController@index');
Route::post('/get-city', 'PublicController@getCity');
Route::get('/get-city', 'PublicController@index');
Route::post('/submit', 'PublicController@submit');
Route::get('/submit', 'PublicController@index');
Route::get('/upload', 'PublicController@index');
Route::get('/download', 'PublicController@download');
Route::get('/download-success', 'PublicController@downloadSuccess');
Route::post('/download', 'PublicController@startDownload');
Route::post('/fire-download', 'PublicController@startDownloadNow');
Route::get('/fire-download', 'PublicController@download');

Route::post('/upload', 'PublicController@upload');

Route::get('/term-and-conditions', 'PublicController@terms');

Route::get('download/facebook', 'PublicController@redirectToProvider');
Route::get('download/facebook/callback', 'PublicController@handleProviderCallback');


Route::group(['prefix' => 'admin/panel'], function() {
    Auth::routes();
});

Route::group(['prefix' => 'admin/panel/'], function() {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/submissions', 'HomeController@submissions');
    Route::get('/home/submission/{id}', 'HomeController@submissionImages');
    Route::get('/home/submission/edit/{id}', 'HomeController@submissionEdit');
    Route::post('/home/submission/update', 'HomeController@submissionUpdate');
    Route::post('/home/submission/edit/add/code', 'HomeController@addCode');
    Route::post('/home/submission/send/code', 'HomeController@sendCode');
    Route::post('/home/submission/export', 'HomeController@submissionExport');
    Route::post('/home/submission/export/code', 'HomeController@submissionExportCode');
    Route::post('/home/submission/edit/add-image', 'HomeController@addImage');

    Route::get('/home/downloads', 'HomeController@downloads');
    Route::post('/home/downloads/export', 'HomeController@downloadExport');
});
