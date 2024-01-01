<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Project;
use App\Models\Workspace;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('project.{project}', function ($user, Project $project) {
    $worspace_project_id = $project->workspace_ID;
    $results = DB::select('select * from user_workspace where workspace_ID = ? and user_ID = ?', [$worspace_project_id, $user->id]);
    if ($results) {
        return true;
    }
    return false;
});


// Broadcast::channel('workspace.{workspace_}', function ($user, Workspace $workspace) {})
Broadcast::channel('workspace.{workspace}', function ($user,Workspace $workspace) {
    return User::isBelongsToWorkspace((int) $user->id, (int) $workspace->id);
});
