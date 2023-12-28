<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

class QueryDataController extends Controller
{

    public function getProject($id_workspace)
    {
        $id_user = session('id_user');
        $workspaces = User::find($id_user)->workspaces();

        //Get workspace data from workspace_id
        $getWorkspace = Workspace::where('id', $id_workspace)->first();

        //Get project data from workspace_id
        $projects_getworkspace =  Workspace::find($id_workspace)->projects;


        return view('showManyProject', ['projects_getworkspace' => $projects_getworkspace, 'workspaces' => $workspaces, 'getWorkspace' => $getWorkspace]);
    }

    public function updateWorkspace($id_workspace, Request $request)
    {
        $name_workspace = $request->title;

        if (isset($name_workspace)) {
            $update_workspace = Workspace::find($id_workspace);
            $update_workspace->name = $name_workspace;
            $update_workspace->save();
        }

        return redirect()->route('worksapce_project', ['id' => $id_workspace]);
    }

    public function createWorkspace(Request $request)
    {

        if ($request->name_workspace && $request->hasFile('avatar_workspace')) {
            $workspace = new Workspace;

            $workspace->name = $request->name_workspace;
            $workspace->admin_ID = session('id_user');
            $image = $request->file('avatar_workspace');

            // Lấy tên file gốc
            $imageFileName = $image->getClientOriginalName();

            // Gán đường dẫn file vào trường avatar
            $workspace->avatar = 'pages/image/' . $imageFileName;

            // Di chuyển file đến đường dẫn mong muốn
            $path_avatar = $image->move('pages/image', $imageFileName);

            $workspace->save();

            DB::table('user_workspace')->insert([
                'workspace_ID' => $workspace->id,
                'user_ID' => session('id_user')
            ]);

            return redirect()->route('homepageAfterLogin');
        }
    }
}
