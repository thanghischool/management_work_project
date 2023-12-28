<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddPeopleController extends Controller
{
    public function addPeople(Request $request)
    {
        $workspace_id = $request->workspace_id;
        $email_user = $request->email;

        $user = User::where('email', $email_user)->first();

        if ($user) {
            DB::table('user_workspace')->insert([
                'workspace_ID' => $workspace_id,
                'user_ID' => $user->id
            ]);

            return redirect()->back();
        } else {
            $error_user = "Not found use";
            return redirect()->back()->withErrors(['error_user' => $error_user]);
        }
    }
}
