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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    return response()->json(['message' => 'API endpoint not found. Please check your request.'], 404);
});

// 메일용 api
Route::controller(\App\Http\Controllers\AgentMail\AgentMailController::class)->prefix('mail')->group(function () {
    Route::get('template/{file}', 'template');
    Route::post('data', 'data');
});

/*
|--------------------------------------------------------------------------
| easyPay
|--------------------------------------------------------------------------
*/
Route::controller(\App\Http\Controllers\EasyPay\EasyPayController::class)->prefix('easyPay')->group(function() {
    Route::post('{payType}/result', 'result');
});
