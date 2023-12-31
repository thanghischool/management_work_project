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
use App\Models\Column;
use App\Http\Controllers\ProfileController;

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


// Route::middleware(['signedin'])->get('/workspace', [WorkspaceData::class, 'dataProject']);


// Route::get('fetchdata', [FetchDataController::class, 'index']);

// Route::get('/', function () {
//     return view('testRoute');
// })->name('homepageAfterLogin');
// Route::get('/login', function () {
//     return view('login');
// });




Route::middleware(['signedin'])->group(
    function () {
        Route::get('/workspace', [WorkspaceData::class, 'dataProject'])->name('homepageAfterLogin');
        Route::post('/workspace/{id?}', [QueryDataController::class, 'createWorkspace'])->name('create_Workspace');
        Route::middleware("auth.member")->get('/workspace/{id_workspace}', [QueryDataController::class, 'getProject'])->name('worksapce_project');
        Route::post('/workspace/{id}', [QueryDataController::class, 'updateWorkspace'])->name('update_Workspace');
        Route::get('/chatbox', function () {
            return view('chatbox');
        });
        Route::get('/card', function () {
            // Column::destroy(24);
            return view('card');
        });

        Route::get('workspace/{workspace}/project/{project}', [WorkspaceData::class, 'showDataProject']);
        Route::post('workspace/{id_workspace}/project/{project}', [QueryDataController::class, 'updateWorkspace']);
        Route::get('/project', function () {
            return view('projectView');
        });
        Route::get('/member', function () {
            return view('memberView');
        });
        Route::controller(LoginController::class)->group(function () {
            Route::get('/logout', 'logout')->name('logout');
        });
        Route::post('/update-profile', [ProfileController::class, 'update'])->name('profileUpdate');
        Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profileEdit');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    }
);
Route::middleware(['notsigned'])->group(function () {
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


    Route::controller(LoginGoogleController::class)->group(function () {
        Route::get('Sshow', 'Sshow')->name('Sshow');
    });
});
