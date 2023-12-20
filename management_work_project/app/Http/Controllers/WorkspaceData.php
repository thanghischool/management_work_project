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


        $workspaces = User::find(1)->workspaces()->get();
        // $workspaces_id = User::find(1)->workspaces()->pluck('id');

        $projects = collect();
        // foreach ($workspaces_id as $workspace_id) {
        //     $project_take = Workspace::find($workspace_id)->projects()->get();
        //     $projects = $projects->merge($project_take);
        // }
        foreach ($workspaces as $workspace) {
            $project_take = Workspace::find($workspace->id)->projects()->get();
            $projects = $projects->merge($project_take);
        }

        return view('workspace', ['workspaces' => $workspaces, 'projects' => $projects, 'randomProjects' => $randomProjects]);
    }
    public function showDataProject(Project $project){
        $workspace = $project->workspace;
        $workspaces = User::find(1)->workspaces()->get();
        $columns = $project->columns;
        foreach ($columns as $column){
            $cards = $column->cards;
        }
        return view('projectView', compact('project', 'columns', 'workspace', 'project', 'workspaces'));
    }
}
