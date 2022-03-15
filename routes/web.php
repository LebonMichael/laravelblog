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
    return view('index');

});
/*
Route::get('/contact', function (){
    return view('contactformulier');
});*/

Route::get('/contactformulier', 'App\Http\Controllers\ContactController@create');
Route::post('/contactformulier', 'App\Http\Controllers\ContactController@store');
//verify zorgt er voor dat enkel een geverifieerde user wordt toegelaten
//aan de geautentiseerde routes
Auth::routes(['verify' => true]);

/** BACKEND ROUTES **/

/*Route::resource('admin/users', App\Http\Controllers\AdminUsersController::class);*/

/*Route::middleware(['auth'])->group(function(){
    Route::resource('admin/users', App\Http\Controllers\AdminUsersController::class);
});*/

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::get('users/restore/{user}','App\Http\Controllers\AdminUsersController@restore')->name('users.restore');

});

/** Beveiligd alle routes na admin (eerst inloggen) **/
//Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin]], function(){
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::resource('photos', App\Http\Controllers\AdminPhotosController::class);
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('homebackend');
});
