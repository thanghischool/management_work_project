<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $table = "lists";
    public function cards(){
        return $this->hasMany(Card::class);
    }
    public function project(){
        return $this->belongsTo(Project::class, "project_ID", "id");
    }
}
