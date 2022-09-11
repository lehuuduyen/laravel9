<?php

use App\Http\Controllers\CalendarController;
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





Route::group(['middleware' => 'web'], function () {
    Route::resources([
        'page'  => App\Http\Controllers\PageController::class,
        'category'  => App\Http\Controllers\CategoryController::class,
        'config'    => App\Http\Controllers\ConfigFieldController::class,
        'post'    => App\Http\Controllers\PostController::class,
    ]);
    Route::get('change-language/{language}', 'App\Http\Controllers\HomeController@changeLanguage')
        ->name('user.change-language');
    //fullcalender
    Route::get('calendar-event',  'App\Http\Controllers\CalendarController@index');
    Route::get('calendar-detail',  'App\Http\Controllers\CalendarController@detail');
    Route::post('calendar-crud-ajax', 'App\Http\Controllers\CalendarController@calendarEvents');
});


Route::group(
    ['prefix' => 'file-manager'],
    function () {
        Route::get('/', 'App\Http\Controllers\FileManager\FileManagerController@index');

        Route::get('/errors', 'App\Http\Controllers\FileManager\FileManagerController@getErrors');

        Route::any('/upload', 'App\Http\Controllers\FileManager\UploadController@upload')->name('filemanager.upload');

        Route::get('/jsonitems', 'App\Http\Controllers\FileManager\ItemsController@getItems');

        /*Route::get('/move', 'ItemsController@move');

        Route::get('/domove', 'ItemsController@domove');*/

        Route::post('/newfolder', 'App\Http\Controllers\FileManager\FolderController@addfolder');

        Route::get('/folders', 'App\Http\Controllers\FileManager\FolderController@getFolders');

        /*Route::get('/rename', 'RenameController@getRename');

        Route::get('/download', 'DownloadController@getDownload');*/

        Route::post('/delete', 'App\Http\Controllers\FileManager\DeleteController@delete');
    }
);
