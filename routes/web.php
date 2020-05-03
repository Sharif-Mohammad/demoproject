<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('menu-position', 'MenuPositionController');
	Route::get('unpublished-menu-position/{id}', 'MenuPositionController@unpublishedMenuPosition')->name('unpublished.menu-position');
	Route::get('published-menu-position/{id}', 'MenuPositionController@publishedMenuPosition')->name('published.menu-position');

	Route::get('unpublished-menu-position-active/{id}', 'MenuPositionController@unpublishedMenuPositionActive')->name('unpublished.menu-position.active');
	Route::get('published-menu-position-active/{id}', 'MenuPositionController@publishedMenuPositionActive')->name('published.menu-position.active');

	Route::resource('menu', 'MenuController');
	Route::get('unpublished-menu/{id}', 'MenuController@unpublishedMenu')->name('unpublished.menu');
	Route::get('published-menu/{id}', 'MenuController@publishedMenu')->name('published.menu');
});
