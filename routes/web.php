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
    return redirect('/login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('sites')->group(function () {
    Route::get('export', 'SitesController@export')->name('sites.export');
});

Route::resource('sites', 'SitesController');
