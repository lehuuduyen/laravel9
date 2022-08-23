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


Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');





Route::group(['middleware' => 'web'], function() {
    Route::resources([
        'page'  => App\Http\Controllers\PageController::class,
        'category'  => App\Http\Controllers\CategoryController::class,
        'config'    => App\Http\Controllers\ConfigFieldController::class,
        'post'    => App\Http\Controllers\PostController::class,
    ]);
    Route::get('change-language/{language}', 'App\Http\Controllers\HomeController@changeLanguage')
        ->name('user.change-language');
});


// $listCategory = Category::all();
// foreach ($listCategory as $category) {
//     // Route::resources("/$category->slug", [App\Http\Controllers\PostController::class, 'index']);
// }
