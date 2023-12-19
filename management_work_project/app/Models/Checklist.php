<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;
    protected $table = "checklists";
    public function tasks(){
        return $this->hasMany(Task::class,"checklist_ID", "id");
    }
    public function card(){
        return $this->belongsTo(Card::class, "card_ID", "id");
    }
}
