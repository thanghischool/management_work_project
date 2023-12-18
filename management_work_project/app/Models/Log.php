<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = "logs";
    public function card(){
        return $this->belongsTo(Card::class, "card_ID", "id");
    }
    public function user(){
        return $this->belongsTo(User::class, "user_ID", "id");
    }
}
