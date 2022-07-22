<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/category/new', [App\Http\Controllers\CategoryController::class, 'new'])->name('category_new');
Route::get('/post/list', [App\Http\Controllers\PostController::class, 'index'])->name('listpost');
Route::get('/post/new', [App\Http\Controllers\PostController::class, 'new'])->name('newpost');
Route::get('/post/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('editpost');
Route::get('/top', [App\Http\Controllers\TopController::class, 'top'])->name('top');
Route::get('/config', [App\Http\Controllers\ConfigFieldController::class, 'index'])->name('config');
Route::get('/config/new', [App\Http\Controllers\ConfigFieldController::class, 'new'])->name('newconfig');
Route::post('/config/insert', [App\Http\Controllers\ConfigFieldController::class, 'insert'])->name('insertconfig');
