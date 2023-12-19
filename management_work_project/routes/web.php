<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FetchDataController;
use App\Http\Controllers\WorkspaceData;
use App\Http\Controllers\QueryDataController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/project', function () {
    return view('projectView');
});

Route::get('/member', function () {
    return view('memberView');
});

Route::get('/workspace', [WorkspaceData::class, 'dataProject']);

Route::get('/chatbox', function () {
    return view('chatbox');
});

Route::get('/workspace/{id}', [QueryDataController::class, 'getProject'])->name('worksapce_project');

// Route::get('fetchdata', [FetchDataController::class, 'index']);