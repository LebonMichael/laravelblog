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
Route::get('/post/{post:slug}', 'App\Http\Controllers\AdminPostsController@post')->name('home.post');
Route::get('/category/{category:name}', 'App\Http\Controllers\AdminPostsCategoriesController@category')->name('category');
//verify zorgt er voor dat enkel een geverifieerde user wordt toegelate
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
    Route::resource('comments', App\Http\Controllers\AdminPostCommentsController::class);

});

/** Beveiligd alle routes na admin (eerst inloggen) **/
//Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin]], function(){
Route::group(['prefix' => 'admin', 'middleware' => ['auth','verified']], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('homebackend');
    Route::resource('photos', App\Http\Controllers\AdminPhotosController::class);
    Route::resource('media', App\Http\Controllers\AdminMediasController::class);
    Route::resource('post', App\Http\Controllers\AdminPostsController::class);
    Route::get('/posts/{post:slug}', 'App\Http\Controllers\AdminPostsController@show')->name('posts.show');
});
