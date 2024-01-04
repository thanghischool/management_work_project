<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddPeopleNotification;
use App\Events\AddPeople;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AddPeopleController extends Controller
{
    public function addPeople(Request $request)
    {
        
        $usersenderID = Auth::user()->id;
        $usersenderName = Auth::user()->name;

        $workspace_id = $request->workspace_id;
        $workspace_name = Workspace::find($workspace_id)->name;
        $email_user_receive = $request->email;

        $user_added = User::where('email', $email_user_receive)->first();
        $user_added_name = $user_added->name;
        $user_added_id = $user_added->id;

        if ($user_added) {

            $data = array($usersenderName, $user_added_name, $workspace_name);
            $data_js = [$usersenderName, $user_added_name, $workspace_name];
            //Check wheather the user is added to the workspace
            $check_User_Exist_workspace = DB::table('user_workspace')
                ->where('workspace_id', $workspace_id)
                ->where('user_ID', $user_added->id)
                ->exists();

            if(!$check_User_Exist_workspace) {
            DB::table('user_workspace')->insert([
                'workspace_ID' => $workspace_id,
                'user_ID' => $user_added->id
            ]);
       
            $user_added->notify(new AddPeopleNotification($data));

            broadcast(new AddPeople($user_added_id, $data_js));

            return redirect()->back();
        } else {
            $error_user = "User is added on workspace";
            return redirect()->back()->withErrors(['error_user' => $error_user]);
        }

        } else {
            $error_user = "Not found user";
            return redirect()->back()->withErrors(['error_user' => $error_user]);
        }
    }
}
