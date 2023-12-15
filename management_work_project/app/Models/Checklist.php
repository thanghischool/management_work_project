<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;
    protected $table = "checklists";
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function card(){
        return $this->belongsTo(Checklist::class, "Checklist_ID", "id");
    }
}
