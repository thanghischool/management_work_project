<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Workspace extends Model
{
    use HasFactory;
    protected $table = "workspaces";
    public $timestamps = false;
    public function projects()
    {
        return $this->hasMany(Project::class, "workspace_ID", "id");
    }
    public function users(){
        $users = array();
        $user_IDs = DB::select('select user_ID from user_workspace
        where workspace_ID = :wid', ['wid' => $this->id]);
        if(isset($user_IDs)){
            foreach($user_IDs as $user_ID){
                array_push($users, User::find($user_ID));
            }
        }
        return $users;
    }
    // public function messages()
    // {
    //     return $this->hasMany(Messages::class);
    // }
}