<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Workspace;

class FetchDataController extends Controller
{
    public function index()
    {
        Project::factory()->count(2)->create();
    }
}
