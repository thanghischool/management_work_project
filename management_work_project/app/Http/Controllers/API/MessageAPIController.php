<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use App\Models\Message;
use App\Models\Workspace;
use Carbon\Carbon;
use Auth;
use Log;

class MessageAPIController extends Controller
{
    function create(Request $request){
        $request->validate([
            "workspace_ID" => "integer|min:0|required",
            "content" => "string|required"
        ]);
        $message = new Message;
        $message->content = $request->content;
        $message->user_ID = Auth::id();
        $message->workspace_ID = $request->workspace_ID;
        $message->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $message->save();
        broadcast(new MessageCreated(Auth::user(), $message));
        return $message;
    }
    public function load(Request $request, Workspace $workspace){
        // $messages = Message::where('workspace_ID', $workspace->id)->cursorPaginate(4);
        $messages = $workspace->messages()->cursorPaginate(10);
        return response()->json($messages);
    }
}
