<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $request->validate([
        //     "workspace_ID" => "required|numeric|min:0",
        // ]);
        $result = DB::select("Select * from user_workspace where user_ID = :uid and workspace_ID = :wid", ["uid" => Auth::id(), "wid" => $request->route()->id_workspace]);
        if(count($result) !=0) return $next($request);
        return redirect()->back();
    }
}
