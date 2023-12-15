<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = "projects";
    public function workspace()
    {
        return $this->belongsTo(Workspace::class, "workspace_ID", "id");
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
