<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Broadcasting\PrivateChannel;
use Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'avatar',
        'phone',
        'gender',
        'birthday',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function workspaces()
    {
        $workspaces = DB::select('select w.* from workspaces as w, user_workspace as uw
         where uw.user_ID = :uid and w.id = uw.workspace_ID', ['uid' => session('id_user')]);
        return $workspaces;
    }
    public static function isBelongsToWorkspace($user_ID, $workspace_ID)
    {
        $isBelong = DB::select('select id from user_workspace
        where user_ID = :uid and workspace_ID = :wid', ['uid' => $user_ID, 'wid' => $workspace_ID]);
        return count($isBelong) !== 0;
    }
}
