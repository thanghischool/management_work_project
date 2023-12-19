<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('cards', App\Http\Controllers\API\CardAPIController::class);
Route::post('/cards', [App\Http\Controllers\API\CardAPIController::class, 'store']);
// Route::post('/store', [App\Http\Controllers\API\CardAPIController::class, 'store']);
// Route::get('/cards/{id}', [App\Http\Controllers\API\CardAPIController::class,"getAll"]);
Route::get('/cards/show/{card}', [App\Http\Controllers\API\CardAPIController::class, "show"]);
Route::delete('/cards/{card}', [App\Http\Controllers\API\CardAPIController::class, "destroy"]);
Route::put('/cards/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateTitle"]);