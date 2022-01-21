<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\HomeController;


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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('get_all_news', [HomeController::class, 'get_all_news'])->name('get_all_news');
Route::get('get_featured_news', [HomeController::class, 'get_featured_news'])->name('get_featured_news');

Route::get('get_all_projects/{country_code}', [HomeController::class, 'get_all_projects'])->name('get_all_projects');
