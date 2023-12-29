<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = "projects";
    public $timestamps = false;
    protected $fillable = [
        "title"
    ];
    public function workspace()
    {
        return $this->belongsTo(Workspace::class, "workspace_ID", "id");
    }
    public function columns(){
        return $this->hasMany(Column::class, "project_ID", "id")->orderBy('index');
    }
}
