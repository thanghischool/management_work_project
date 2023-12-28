<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $table = "lists";
    public $timestamps = false;
    protected $fillable = [
        "title", "index", "project_ID"
    ];
    public function cards(){
        return $this->hasMany(Card::class, "list_ID", "id")->orderBy('index');;
    }
    public function project(){
        return $this->belongsTo(Project::class, "project_ID", "id");
    }
}
