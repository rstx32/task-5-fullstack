<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\CategoryController;
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
    // return view('welcome');
    return redirect('/articles');
});

Auth::routes();

Route::get('/home', function(){
    return redirect('/user/articles');
})->name('home');

Route::middleware('auth')->group(function(){
    Route::prefix('user')->group(function(){
        Route::resource('articles', ArticleController::class);
        Route::resource('categories', CategoryController::class);
    });
});

Route::get('/articles', '\App\Http\Controllers\Public\ArticleController@index');
Route::get('/articles/{id}', '\App\Http\Controllers\Public\ArticleController@show');
Route::get('/categories', '\App\Http\Controllers\Public\CategoryController@index');
Route::get('/categories/{id}', '\App\Http\Controllers\Public\CategoryController@show');