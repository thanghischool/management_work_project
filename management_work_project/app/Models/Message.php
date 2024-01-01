<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";
    public $timestamps = false;
    protected $guarded = ["id",];
    public function workspace(){
        return $this->belongsTo(Card::class, "workspace_ID", "id");
    }
}
