<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class QueryDataController extends Controller
{

    public function getProject($id)
    {
        $workspaces = User::find(1)->workspace()->get();
        $projects_getworkspace =  Workspace::find($id)->projects()->get();
        return view('showManyProject', ['projects_getworkspace' => $projects_getworkspace, 'workspaces' => $workspaces]);
    }
}
