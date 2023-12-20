<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistAPIController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * method: POST
     */
    public function store(Request $request)
    {
        $rule = [
            "title" => "required|max:255|string",
            "card_ID" => "required|min:0|integer",
        ];
        $request->validate($rule);
        $checklist = new Checklist;
        $checklist->title = $request->title;
        $checklist->card_ID = $request->card_ID;
        $checklist->save();
        return $checklist;
    }

    /**
     * Update the specified resource in storage.
     * method: PUT
     */
    public function updateTitle(Request $request, Checklist $checklist)
    {
        $rule = [
            "title" => "required|max:255|string", 
        ];
        $request->validate($rule);
        $checklist->title = $request->title;
        $checklist->save();
    }

    /**
     * Remove the specified resource from storage.
     * method: DELETE
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return $checklist;
    }
}
