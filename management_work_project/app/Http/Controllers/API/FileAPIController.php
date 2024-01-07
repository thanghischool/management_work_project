<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Workspace;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\Card;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FileAPIController extends Controller
{
    function test(Request $request){
        $message = "oke";
        $file = $request->file('file');
        // Storage::deleteDirectory('files');
        // Storage::delete('public/2.png');
        // $file->store('files'); // root vẫn là storage/app nhưng lưu vào folder files với tên mặc định, tham số thứ 2 là disk driver
        // $file->storeAs('files', $file->getClientOriginalName()); //  root mặc định sẽ storage/app
        // dd(Storage::size('filetest/2.png'));
        // dd($file->getSize()); // Lấy size của file
        // dd($file->extension()); // get extension
        // dd($file->getClientOriginalName()); // lấy tên file kèm theo đuôi extension
        // dd($file->getBasename()); // lấy tên file .tmp (file tạm thời chưa upload)
        // dd($file->getClientMimeType()); // lấy kiểu extension vào loại file ví dụ image/png
        // dd($file->getMTime());
        // dd(Storage::url('filetest/2.png'));
        // khi storage:link thì sẽ tạo ra link từ storage/app/public
        // $filename = $request->user()->id .'.'. $file->extension();
        // put file thì root mặc định sẽ storage/app
        // if(Storage::putFileAs('public', $file, $filename)){
        //     $message = "Upload successfully!";
        // } else $message = "Upload failed!";
        return view('file',["message" => $message]);
    }
    public function uploadUserAvatar(Request $request){
        $file = $request->file('file');
        $filename = Str::random(30).'u'.$request->user()->id.$file->extension();
        $user = $request->user();
        Storage::exists('public/images/'.$user->avatar);
        Storage::putFileAs('public/images', $file, $filename);
        $user->avatar = 'storage/images/'.$filename;
        $user->save();
        return redirect()->back();
    }
    // public function uploadWorkspaceAvatar(Request $request, Workspace $workspace){
    //     $file = $request->file('file');
    //     $filename = Str::random(30).'w'.$workspace->id.$file->extension();
    //     Storage::putFileAs('public/images', $file, 'wavatar'.$workspace->id.$file->extension());
    //     $workspace->avatar = 'storage/images/'.$filename;
    //     $workspace->save();
    //     return redirect()->back();
    // }

    public function uploadFile(Request $request, Card $card, Workspace $workspace){
        $file_url = $request->file;
        Log::info($card);

        if ($file_url) {
            // Validate file using its URL or path, assuming it's a string
            // $validatedFile = Validator::make(['file_url' => $file_url], [
            //     'file_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            // ]);
        
            // if ($validatedFile->fails()) {
            //     // Handle validation failure
            //     return response()->json([
            //         'error' => 'Invalid file URL',
            //     ]);
            // } else {
                $file = new File;
                // if($card->workspace_ID == $workspace){
                    $file->card_ID = $card->id;
                    $file->workspace_ID = $workspace->id;
                    if($file->upload($file_url)) { 
                        return response()->json([
                            'message' => 'success',
                            'id' => $file->id,
                            'nameFile' => $file->name,
                            'link' => $file->link,
                            'extension' => $file_url->extension(),
                        ]);
                    }
                     else {
                        return response()->json([
                            'error' => 'failed to upload',
                        ]);
                     }
                // } else {
                //     return response()->json([
                //         'error' => 'Not in the same workspace',
                //     ]);;
                // }
            // }
        
            
        } else {
            // Handle the case where $file_url is not available
            return response()->json([
                'error' => 'File URL is missing',
            ]);
        }       
        
    }

    public function deleteFile(File $file) {
        if($file->delete()) {
            return response()->json([
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'error' => 'Failed',
            ]);
        };
    }
}
