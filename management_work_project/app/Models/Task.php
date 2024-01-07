<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";
    public $timestamps = false;
    public function checklist(){
        return $this->belongsTo(Checklist::class, "checklist_ID", "id");
    }
    public function users(){
        $users = array();
        $user_IDs = DB::select('select user_ID from task_user
        where task_ID = :tid', ['tid' => $this->id]);
        if(isset($user_IDs)){
            foreach($user_IDs as $user){
                array_push($users, User::find($user->user_ID, ['id', 'avatar', 'name']));
            }
        }
        return $users;
    }
    // public static function isBelongsToWorkspace($task_ID, $workspace_ID){
    //     $task = Task::find($task_ID);
    //     $checklist = $task->checklist->card->project;
    //     $isBelong = DB::select('select id from user_workspace
    //     where user_ID = :uid and workspace_ID = :wid', ['uid' => $user_ID, 'wid' => $workspace_ID]);
    //     return count($isBelong) !== 0;
    // }
}
