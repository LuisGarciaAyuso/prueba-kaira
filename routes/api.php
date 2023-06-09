<?php

use App\Http\Controllers\UrlController;
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
Route::prefix('v1')
    ->middleware(['validate_bearer_token_pairs_symbols'])
    ->group(function () {
        Route::post('short-urls', [UrlController::class, 'short']);
    });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
