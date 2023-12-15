<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = "cards"; 
    public function checklists(){
        return $this->hasMany(Checklist::class);
    }
    public function files(){
        return $this->hasMany(File::class);
    }
    public function logs(){
        return $this->hasMany(Log::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function logss(){
        return $this->hasMany(Log::class);
    }
    public function column(){
        return $this->belongsTo(Column::class, "list_ID", "id");
    }
}
