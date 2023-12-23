<?php

use App\Http\Controllers\DiraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\LoginFBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FetchDataController;
use App\Http\Controllers\WorkspaceData;
use App\Http\Controllers\QueryDataController;
use App\Http\Controllers\AddPeopleController;
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

Route::get('workspace/{id_workspace}/project/{id_project}', [WorkspaceData::class, 'showDataProject']);

Route::get('/project', function () {
    return view('projectView');
});

Route::get('/member', function () {
    return view('memberView');
});

Route::get('/workspace', [WorkspaceData::class, 'dataProject'])->name('homepageAfterLogin');

Route::get('/chatbox', function () {
    return view('chatbox');
});
Route::get('/card', function () {
    return view('card');
});

Route::get('/workspace/{id}', [QueryDataController::class, 'getProject'])->name('worksapce_project');

Route::post('/workspace/{id}', [QueryDataController::class, 'updateWorkspace'])->name('update_Workspace');

// Route::get('fetchdata', [FetchDataController::class, 'index']);

// Route::get('/', function () {
//     return view('testRoute');
// })->name('homepageAfterLogin');
// Route::get('/login', function () {
//     return view('login');
// });

Route::post('/workspace/{?id}', [QueryDataController::class, 'createWorkspace'])->name('create_Workspace');


Route::get('/login', [LoginController::class, 'getlogin'])->name('login');

Route::post('/login', [LoginController::class, 'postLogin'])->name('plogin');

Route::post('/signup', [LoginController::class, 'postSignup'])->name('psignup');




Route::get('/chinhsach', function () {
    return '<h1>Chinh sach</h1>';
});
Route::get('auth/facebook/callback', function () {
    return 'Call Back Login';
});
Route::get('auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::controller(LoginGoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
    Route::get('logout-home', 'logout_home')->name('logout-home');
});
Route::controller(LoginFBController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::get('/addPeople', [AddPeopleController::class, 'index']);
