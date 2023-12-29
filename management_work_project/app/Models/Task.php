<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";
    public $timestamps = false;
    public function checklist(){
        return $this->belongsTo(Checklist::class, "checklist_ID", "id");
    }
    // public static function isBelongsToWorkspace($task_ID, $workspace_ID){
    //     $task = Task::find($task_ID);
    //     $checklist = $task->checklist->card->project;
    //     $isBelong = DB::select('select id from user_workspace
    //     where user_ID = :uid and workspace_ID = :wid', ['uid' => $user_ID, 'wid' => $workspace_ID]);
    //     return count($isBelong) !== 0;
    // }
}
