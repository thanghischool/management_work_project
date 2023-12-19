<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Workspace;

class WorkspaceData extends Controller
{
    // Get data workspace and project from models
    public function dataProject()
    {

        $randomProjects = Project::inRandomOrder()->limit(3)->get();


        $workspaces = User::find(1)->workspace()->get();
        $workspaces_id = User::find(1)->workspace()->pluck('id');

        $projects = collect();
        foreach ($workspaces_id as $workspace_id) {
            $project_take = Workspace::find($workspace_id)->projects()->get();
            $projects = $projects->merge($project_take);
        }

        return view('workspace', ['workspaces' => $workspaces, 'projects' => $projects, 'randomProjects' => $randomProjects]);
    }
}
