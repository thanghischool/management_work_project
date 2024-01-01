<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;

class CheckProjectBelongToWorkspace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::find($request->route()->originalParameters()["project"]);
        if($project->workspace_ID == $request->route()->originalParameters()["workspace"]){
            return $next($request);
        }
        return redirect()->back();
    }
}
