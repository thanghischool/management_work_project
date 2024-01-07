<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Session;

class MemberPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->is("api/*")){
            $user_ID = Auth::id();
            $result = User::isBelongsToWorkspace($user_ID, $request->route()->originalParameters()["workspace"]);
            if($result) return $next($request);
            return redirect()->back()->withErrors(['message' => "You do not have permission to this workspace !"]);
        } else {
            $user_ID = $request->user()->id;
            if(User::isBelongsToWorkspace($user_ID, $request->route()->workspace)) return $next($request);
            if($request->workspace_ID){
                $request->validate([
                    "workspace_ID" => "required|numeric|min:0",
                ]);
                $request;
                if($request->workspace_ID) $result = User::isBelongsToWorkspace($user_ID, $request->workspace_ID);
                if($result) return $next($request);
            }
            return redirect()->back();
        }
    }
}
