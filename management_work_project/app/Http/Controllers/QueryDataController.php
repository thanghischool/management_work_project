<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Auth;
class QueryDataController extends Controller
{

    public function getProject($id)
    {
        $workspaces = User::find(Auth::user()->id)->workspaces()->get();

        //Get workspace data from workspace_id
        $getWorkspace = Workspace::where('id', $id)->first();

        //Get project data from workspace_id
        $projects_getworkspace =  Workspace::find($id)->projects()->get();
        return view('showManyProject', ['projects_getworkspace' => $projects_getworkspace, 'workspaces' => $workspaces, 'getWorkspace' => $getWorkspace]);
    }
}