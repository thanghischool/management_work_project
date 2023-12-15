<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/workspace', function () {
    return view('workspace');
});

Route::get('/chatbox', function () {
    return view('chatbox');
});

Route::get('/homepage', function () {
    return view('homepage');
});
