<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = [
        'email',
        'comment',
        'datetime'
    ];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class, "user_ID", "id");
    }
    public function card(){
        return $this->belongsTo(Card::class, "card_ID", "id");
    }
}
