<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectAPIController extends Controller
{
    function create(Request $request){
        $request->validate([
            "name" => "string|required|max:100",
            "workspace_ID" => "integer|required|min:0"
        ]);
        $project = new Project;
        $project->name = $request->name;
        $project->workspace_ID = $request->workspace_ID;
        $project->save();
        return $project;
    }
    function updateName(Request $request, Project $project){
        $request->validate([
            "name" => "string|required|max:100",
        ]);
        $project->name = $request->name;
        $project->save();
        return $project;
    }
    function destroy(Project $project){
        $project->delete();
        return $project;
    }
}
