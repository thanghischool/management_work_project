<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Workspace;
use App\Models\Column;
use Auth;
use Illuminate\Support\Facades\DB;


class WorkspaceData extends Controller
{
    // Get data workspace and project from models
    public function dataProject()
    {
        $id_user = session('id_user');
        $randomProjects = Project::inRandomOrder()->limit(3)->get();
        $workspaces = User::find($id_user)->workspaces();
        $projects = collect();
        foreach ($workspaces as $workspace) {
            $project_take = Workspace::find($workspace->id)->projects;
            $projects = $projects->merge($project_take);
        }
        return view('workspace', ['workspaces' => $workspaces, 'projects' => $projects, 'randomProjects' => $randomProjects]);
    }


    public function showDataProject(Workspace $workspace,  Project $project)
    {
        $user_ID_array =  DB::table('user_workspace')->where('workspace_ID', $workspace->id)->pluck('user_ID');
        $users_workspace = User::whereIn('id', $user_ID_array)->get();
        $id_user = session('id_user');
        $workspaces = User::find($id_user)->workspaces();
        $columns = $project->columns;
        foreach ($columns as $column) {
            $cards = $column->cards;
        }
        return view('projectView', compact('project', 'columns', 'workspace', 'workspaces', 'users_workspace'));
    }
}
