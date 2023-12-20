<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddPeopleController extends Controller
{
    public function index()
    {
        return view('addPeople');
    }

    public function addPeople(Request $request)
    {
    }
}
