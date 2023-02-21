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
    Route::get('edit-credentials/{id}', 'SitesController@editSiteCredentials')->name('sites.edit-credentials');
    Route::post('store-credentials', 'SitesController@storeSiteCredentials')->name('sites.store-credentials');
});

Route::prefix('airtable')->group(function () {
    Route::get('models/{siteId}', 'AirTableController@fetchModels')->name('airtable.models');
});

Route::resource('sites', 'SitesController');
