<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CardAPIController;
use App\Http\Controllers\API\CommentAPIController;

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

Route::post('/cards', [App\Http\Controllers\API\CardAPIController::class, 'store']);
Route::get('/cards/show/{card}', [App\Http\Controllers\API\CardAPIController::class, "show"]);
Route::delete('/cards/{card}', [App\Http\Controllers\API\CardAPIController::class, "destroy"]);
Route::put('/cards/title/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateTitle"]);
Route::put('/cards/index/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateIndex"]);
Route::put('/cards/description/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateDescription"]);

Route::apiResource('comments',CommentAPIController::class);



 
Route::put('/lists/index/{list}', [App\Http\Controllers\API\ListAPIController::class, "updateIndex"]);
Route::put('/lists/title/{list}', [App\Http\Controllers\API\ListAPIController::class, "updateTitle"]);
Route::post('/lists', [App\Http\Controllers\API\ListAPIController::class, "store"]);

Route::post('/workspaces/{workspace}/checklists/{checklist}', [App\Http\Controllers\API\ChecklistAPIController::class,"storeItem"]);
