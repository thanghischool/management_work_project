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
use App\Http\Controllers\ChatBoxController;
use App\Http\Controllers\API\FileAPIController;

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

        Route::post('/workspace', [QueryDataController::class, 'createWorkspace'])->name('create_Workspace');
        Route::post('/addpeople', [AddPeopleController::class, 'addPeople'])->name('addPeopleOnTeam');
        Route::middleware("auth.member")->get('/workspace/{workspace}', [QueryDataController::class, 'getProject'])->name('worksapce_project');
        Route::post('/workspace/{workspace}', [QueryDataController::class, 'updateWorkspace'])->name('update_Workspace');

        // Route::post('/workspace', [QueryDataController::class, 'createWorkspace'])->name('create_Workspace');
        // Route::middleware("auth.member")->get('/workspace/{workspace}', [QueryDataController::class, 'getProject'])->name('worksapce_project');
        // Route::post('/workspace/{workspace}', [QueryDataController::class, 'updateWorkspace'])->name('update_Workspace');

        Route::get('/chatbox', function () {
            return view('chatbox');
        });
        Route::get('/card', function () {
            // Column::destroy(24);
            return view('card');
        });

        Route::middleware(['auth.member','auth.workspace.project'])->get('workspace/{workspace}/project/{project}', [WorkspaceData::class, 'showDataProject']);
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
        
        Route::get('/workspace/{workspace}/chatbox', [ChatBoxController::class, "index"]);
    }
);
Route::middleware(['notsigned'])->group(function () {
    Route::get('/forget-password', [LoginController::class, 'forgetPass'])->name('forgetPass');

    Route::post('/forget-password', [LoginController::class, 'postForgetPass'])->name('postForgetPass');

    Route::get('/get-password/{user}/{token}', [LoginController::class, 'getPass'])->name('getPass');

    Route::post('/get-password/{user}/{token}', [LoginController::class, 'postGetPass'])->name('postGetPass');


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
        Route::get('/404',function(){return view('404');});
});
Route::get('/testfile/{workspace}/card/{card}', function ($workspace, $card){
    return view('file', compact('workspace', 'card'));
});
Route::post('/file/{workspace}/card/{card}', [FileAPIController::class, 'uploadFile'])->name('postFile');
Route::get('/file/{file}', [FileAPIController::class, 'deleteFile']);
Route::get('/testtt/{card}', [App\Http\Controllers\API\CardAPIController::class, "index"]);
Route::get('/', function(){
    return view('homepage');
});