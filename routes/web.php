<?php

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManagerController;

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


Route::get('/laravel-filemanager/demo', [Unisharp\Laravelfilemanager\controllers\DemoController::class, 'index'])->name('home');

Route::group(['prefix' => 'laravel-filemanager','middleware' => 'auth'], function () {
    Route::get('/', 'Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\controllers\UploadController@upload');
    // list all lfm routes here...
});
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/category/new', [App\Http\Controllers\CategoryController::class, 'new'])->name('category_new');
Route::post('/category/insert', [App\Http\Controllers\CategoryController::class, 'insert'])->name('category_insert');

Route::get('/post/list', [App\Http\Controllers\PostController::class, 'index'])->name('listpost');
Route::get('/post/new', [App\Http\Controllers\PostController::class, 'new'])->name('newpost');
Route::get('/post/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('editpost');
Route::get('/top', [App\Http\Controllers\TopController::class, 'top'])->name('top');

Route::get('/config', [App\Http\Controllers\ConfigFieldController::class, 'index'])->name('config');
Route::get('/config/new', [App\Http\Controllers\ConfigFieldController::class, 'new'])->name('newconfig');
Route::post('/config/insert', [App\Http\Controllers\ConfigFieldController::class, 'insert'])->name('insertconfig');


$listCategory = Category::all();
foreach ($listCategory as $category) {
    Route::get("/$category->slug", [App\Http\Controllers\PostController::class, 'index']);
    Route::get("/$category->slug/new", [App\Http\Controllers\PostController::class, 'new']);
    Route::post("/$category->slug/insert", [App\Http\Controllers\PostController::class, 'insert']);
}
