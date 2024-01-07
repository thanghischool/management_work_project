<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CardAPIController;
use App\Http\Controllers\API\CommentAPIController;
use App\Http\Controllers\API\MessageAPIController;
use App\Http\Controllers\API\ChecklistAPIController;

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

Route::middleware(["auth.member"])->group(function(){
    Route::get('{workspace}/card/{card}', [App\Http\Controllers\API\CardAPIController::class, 'index']);
    Route::post('/cards', [App\Http\Controllers\API\CardAPIController::class, 'store']);
    Route::get('/cards/show/{card}', [App\Http\Controllers\API\CardAPIController::class, "show"]);
    Route::delete('/cards/{card}', [App\Http\Controllers\API\CardAPIController::class, "destroy"]);
    Route::put('/cards/title/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateTitle"]);
    Route::put('/cards/index/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateIndex"]);
    Route::put('/cards/description/{card}', [App\Http\Controllers\API\CardAPIController::class, "updateDescription"]);

    Route::apiResource('comments',CommentAPIController::class);



    
    Route::put('/lists/index/{list}', [App\Http\Controllers\API\ListAPIController::class, "updateIndex"]);
    Route::put('/lists/title/{list}', [App\Http\Controllers\API\ListAPIController::class, "updateTitle"]);
    Route::delete("/lists/{column}", [App\Http\Controllers\API\ListAPIController::class, "destroy"]);
    Route::post('/lists', [App\Http\Controllers\API\ListAPIController::class, "store"]);
    Route::post('/workspaces/{workspace}/checklists/{checklist}', [App\Http\Controllers\API\ChecklistAPIController::class,"storeItem"]);

    Route::post('/messages', [MessageAPIController::class, "create"]);
    Route::get('/workspace/{workspace}/chatbox', [MessageAPIController::class, "load"]);

    Route::post('/project', [App\Http\Controllers\API\ProjectAPIController::class, "create"]);
    Route::put('/project/{project}', [App\Http\Controllers\API\ProjectAPIController::class, "updateName"]);
    Route::delete('/project/{project}', [App\Http\Controllers\API\ProjectAPIController::class, "destroy"]);

    Route::post('/checklist', [ChecklistAPIController::class, "store"]);
    Route::put('/checklist/{checklist}', [ChecklistAPIController::class, "updateTitle"]);
    Route::delete('/checklist/{checklist}', [ChecklistAPIController::class, "destroy"]);

    Route::post('/checklist/{checklist}/task', [ChecklistAPIController::class, "storeItem"]);
    Route::put('/task/{task}', [ChecklistAPIController::class, "updateItem"]);
    Route::delete('/task/{task}', [ChecklistAPIController::class, "removeItem"]);
});

