<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use Auth;
use App\Models\Message;

class ChatBoxController extends Controller
{
    public function index(Request $request, Workspace $workspace){
        $messages = $workspace->messages;
        $workspaces = Auth::user()->workspaces();
        return view('chatbox', compact('messages', 'workspace', 'workspaces'));
    }
}
