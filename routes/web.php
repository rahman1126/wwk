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
Route::get('/download', 'PublicController@download');
Route::get('/download-success', 'PublicController@downloadSuccess');
Route::post('/download', 'PublicController@startDownload');
Route::post('/fire-download', 'PublicController@startDownloadNow');

Route::get('download/facebook', 'PublicController@redirectToProvider');
Route::get('download/facebook/callback', 'PublicController@handleProviderCallback');


Route::group(['prefix' => 'admin/panel'], function() {
    Auth::routes();
});

Route::group(['prefix' => 'admin/panel/'], function() {
    Route::get('/home', 'HomeController@index');
});
