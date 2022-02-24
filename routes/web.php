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

Auth::routes();



/** BACKEND ROUTES **/



/*Route::resource('admin/users', App\Http\Controllers\AdminUsersController::class);*/

/*Route::middleware(['auth'])->group(function(){
    Route::resource('admin/users', App\Http\Controllers\AdminUsersController::class);
});*/

/** Beveiligd alle routes na admin (eerst inloggen) **/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('homebackend');
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
});
