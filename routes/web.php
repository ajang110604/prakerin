<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

use App\Controller\MyController;


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

Route::get('/about', function () {
    return '<h1>Halo</h1>'
        . 'Selamat datang di webapp saya<br>'
        . 'Laravel, emang keren.';
});

Route::get('/testmodel', function () {
    $query = Post::all();
    return $query;
});

Route::get('/about', 'MyController@showAbout');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth'], 'prefix' => 'client-area'], function () {
     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', function () {
        return view('layouts.admin');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('profile', function () {
        return view('profile');
    });
});

Route::get('/errors', function () {
    return view('403');
});
