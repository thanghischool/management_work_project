<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;
    protected $table = "workspaces";
    public function workspace(){
        return $this->belongsTo(Workspace::class, "workspace_ID", "id");
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function messages(){
        return $this->hasMany(Messages::class);
    }
}