<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = "cards";
    protected $fillable = [
        "index", 'list_ID', 'title', "description"
    ];
    public $timestamps = false;
    public function checklists(){
        return $this->hasMany(Checklist::class, "card_ID", "id");
    }
    public function files(){
        return $this->hasMany(File::class, "card_ID", "id");
    }
    public function logs(){
        return $this->hasMany(Log::class, "card_ID", "id");
    }
    public function comments(){
        return $this->hasMany(Comment::class, "card_ID", "id")->orderBy("created_at");
    }
    public function logss(){
        return $this->hasMany(Log::class, "card_ID", "id")->orderBy("created_at");
    }
    public function column(){
        return $this->belongsTo(Column::class, "list_ID", "id");
    }
}
