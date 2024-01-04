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
        $check_notification_user = DB::table('notifications')
                                    ->where('notifiable_id', $id_user)->get();
        if($check_notification_user) {
            $notification_user = $check_notification_user->pluck('data')->all();
        } else {
            $notification_user = "";
        }

        $randomProjects = Project::inRandomOrder()->limit(3)->get();
        $workspaces = User::find($id_user)->workspaces();
        $projects = collect();
        foreach ($workspaces as $workspace) {
            $project_take = Workspace::find($workspace->id)->projects;
            $projects = $projects->merge($project_take);
        }
        return view('workspace', ['workspaces' => $workspaces, 'projects' => $projects, 'randomProjects' => $randomProjects, 'id_user' => $id_user, 'notification_user' => $notification_user]);
    }


    public function showDataProject(Workspace $workspace,  Project $project)
    {
        $user_ID_array =  DB::table('user_workspace')->where('workspace_ID', $workspace->id)->pluck('user_ID');
        $users_workspace = User::whereIn('id', $user_ID_array)->get();
        $id_user = session('id_user');

        $check_notification_user = DB::table('notifications')
                                    ->where('notifiable_id', $id_user)->get();
        if($check_notification_user) {
            $notification_user = $check_notification_user->pluck('data')->all();
        } else {
            $notification_user = "";
        }

        $workspaces = User::find($id_user)->workspaces();
        $columns = $project->columns;
        foreach ($columns as $column) {
            $cards = $column->cards;
        }
        return view('projectView', compact('project', 'columns', 'workspace', 'workspaces', 'users_workspace', 'notification_user'));
    }
}
