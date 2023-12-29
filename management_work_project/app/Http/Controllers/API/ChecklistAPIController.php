<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChecklistAPIController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * method: POST
     */
    public function store(Request $request)
    {
        $rule = [
            "title" => "required|max:255|string",
            "card_ID" => "required|min:0|integer",
        ];
        $request->validate($rule);
        $checklist = new Checklist;
        $checklist->title = $request->title;
        $checklist->card_ID = $request->card_ID;
        $checklist->save();
        return $checklist;
    }

    /**
     * Update the specified resource in storage.
     * method: PUT
     */
    public function updateTitle(Request $request, Checklist $checklist)
    {
        $rule = [
            "title" => "required|max:255|string", 
        ];
        $request->validate($rule);
        $checklist->title = $request->title;
        $checklist->save();
    }

    /**
     * Remove the specified resource from storage.
     * method: DELETE
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return $checklist;
    }
    // body: user_IDs
    public function storeItem(Request $request, Workspace $workspace, Checklist $checklist){
        $request->validate([
            "content" => "required|max:255|string",
        ]);
        $overdue = Carbon::parse($request->overdue);
        if ($overdue->gt(Carbon::now()->format("Y-m-d\Th:i"))){
            $task = new Task;
            $task->content = $request->content;
            $task->checklist_ID = $checklist->id;
            $task->overdue = $request->overdue;
            $task->save();
            $users = array();
            if(isset($request->user_IDs)){
                foreach($request->user_IDs as $user_ID){
                    if(User::isBelongsToWorkspace($user_ID, $workspace->id)){
                        $values = array("task_ID" => $task->id, "user_ID" => $user_ID);
                        DB::table('task_user')->insert($values);
                        array_push($users, User::find($user_ID));
                    }
                }
            }
            return ["task" => $task, "users" => $users];
        }
        return response()->json(["data" => "khong co gi"]);
    }
    // Delete a task
    // method delete
    public function removeItem(Task $task){
        $task->delete();
        return $task;
    }
    public function updateItem(Request $request, Task $task){
        $request->validate([
            "content" => "required|max:255|string",
        ]);
        $overdue = Carbon::parse($request->overdue);
        if ($overdue->gt(Carbon::now()->format("Y-m-d\Th:i"))){
            $task->content = $request->content;
            $task->overdue = $request->overdue;
            $task->save();
            $users = array();
            if(isset($request->user_IDs)){
                DB::table('task_user')->where("task_ID",$task->id)->delete();
                foreach($request->user_IDs as $user_ID){
                    if(User::isBelongsToWorkspace($user_ID, $workspace->id)){
                        $values = array("task_ID" => $task->id, "user_ID" => $user_ID);
                        DB::table('task_user')->insert($values);
                        array_push($users, User::find($user_ID));
                    }
                }
            }
            return ["task" => $task, "users" => $users];
        }
        return response()->json(["data" => "khong co gi"]);
    }
}
