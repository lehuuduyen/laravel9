<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/staff_service', 'App\Http\Controllers\Api\StaffController@index');


Route::group(['middleware' => 'api'], function() {
    Route::apiResource('config', 'App\Http\Controllers\Api\ConfigFieldController');
    Route::apiResource('list_category', 'App\Http\Controllers\Api\CategoryController');
    Route::apiResource('page', 'App\Http\Controllers\Api\PageController');
    Route::apiResource('post', 'App\Http\Controllers\Api\PostController');
    Route::get('/top', 'App\Http\Controllers\Api\PageController@topPage');
    Route::get('/info', 'App\Http\Controllers\Api\PageController@info');
    Route::get('/category', 'App\Http\Controllers\Api\PageController@getCategoryBySlug');
    Route::get('/item_detail', 'App\Http\Controllers\Api\PageController@itemDetailPost');
    Route::get('/get_page', 'App\Http\Controllers\Api\PageController@getPageBySlug');
    Route::get('/recruit', 'App\Http\Controllers\Api\PageController@getRecruit');
    Route::get('/recruit_detail', 'App\Http\Controllers\Api\PageController@getRecruitDetail');
});

