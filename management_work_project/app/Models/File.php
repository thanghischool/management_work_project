<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class File extends Model
{
    use HasFactory;
    protected $table = "files";
    public $timestamps = false;
    public function card(){
        return $this->belongsTo(Card::class, "card_ID", "id");
    }
    public function upload($file){
        if(!$this->card_ID || !$this->workspace_ID) return false;
        $this->name = $file->getClientOriginalName();
        $this->save();
        $filename = Str::random(30).'f'.$this->id.'.'.$file->extension();
        Storage::putFileAs('public/'.$this->workspace_ID.'/files', $file, $filename);
        $this->link = "storage/".$this->workspace_ID."/files"."/".$filename;
        $this->save();
        return true;
    }
    public function delete(){
        $filenames = explode('/',$this->link);
        $filename = $filenames[count($filenames)-1];
        if(Storage::exists('public/'.$this->workspace_ID.'/files/'.$filename)){
            Storage::delete('public/'.$this->workspace_ID.'/files/'.$filename);
        }
        DB::table('files')->where('id', $this->id)->delete();
    }
}
