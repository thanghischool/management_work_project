<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiraController extends Controller
{
    public function getlogin(){
        return view('login');
    }
}
