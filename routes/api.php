<?php

use App\Http\Controllers\Api\V1\{AccountController, RegisterController};
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

Route::prefix('v1')->group(function() {
    // should be authenticated
    Route::get('accounts', [AccountController::class, 'index']);
    Route::post('register', [RegisterController::class, 'register']);
});
