<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = "files";
    public function card(){
        return $this->belongsTo(Card::class, "card_ID", "id");
    }
}
