<?php

use App\Http\Controllers\DiraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\LoginFBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FetchDataController;
use App\Http\Controllers\WorkspaceData;
use App\Http\Controllers\QueryDataController;

use Laravel\Socialite\Facades\Socialite;

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

Route::get('/project/{project}', [WorkspaceData::class, 'showDataProject']);
Route::get('/', function () {
    return view('welcome');
});
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
Route::get('/card', function () {
    return view('card');
});

Route::get('/workspace/{id}', [QueryDataController::class, 'getProject'])->name('worksapce_project');

// Route::get('fetchdata', [FetchDataController::class, 'index']);

Route::get('/', function () {
    return view('testRoute');
});
// Route::get('/login', function () {
//     return view('login');
// });


Route::get('/login', [LoginController::class, 'getlogin'])->name('login');

Route::post('/login', [LoginController::class, 'postLogin'])->name('plogin');

Route::post('/signup', [LoginController::class, 'postSignup'])->name('psignup');





Route::controller(LoginGoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
    Route::get('/logout-home', 'logout_home')->name('logout-home');
});
Route::controller(LoginFBController::class)->group(function () {
    Route::get('/auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('/auth/facebook/callback', 'handleFacebookCallback');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
   
    
});

Route::controller(LoginGoogleController::class)->group(function () {
    Route::get('Sshow', 'Sshow')->name('Sshow');
});