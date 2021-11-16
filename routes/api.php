<?php

use App\Http\Controllers\WebsiteController;
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

Route::get('/websites', [WebsiteController::class, 'index']);
Route::get('/websites/{id}', [WebsiteController::class, 'show']);
Route::post('/websites/{id}/subscribers', [WebsiteController::class, 'storeSubscriber']);
Route::post('/websites/{id}/articles', [WebsiteController::class, 'storeArticle']);
