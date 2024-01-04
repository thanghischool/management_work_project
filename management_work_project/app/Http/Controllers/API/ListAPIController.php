<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Project;
use App\Events\ModifyListPosition;
use App\Events\ModifyListTitle;
use App\Events\ListCreated;
use App\Events\ListDeleted;
use Log;

class ListAPIController extends Controller
{
    public function updateIndex(Request $request, Column $list){
        $request->validate([
            'index' => 'integer|min:0'
        ]);
        $lists = Column::where("project_ID", "=", $list->project_ID)->get();
        $length = count($lists);
        if ($length <= $request->index) return $list;
        if ($list->index < $request->index){
            $listsFilter = array();
            foreach($lists as $value){
                if ($value->index <= $request->index && $value->index > $list->index) array_push($listsFilter, $value);
            }
            foreach($listsFilter as $listf){
                // ta - 1 cho tất cả card đã lấy về và lưu lại
                $listf->index -= 1;
                $listf->save();
            }
        } else if ($list->index > $request->index){
            $listsFilter = array();
            foreach($lists as $value){
                if ($value->index >= $request->index && $value->index < $list->index) array_push($listsFilter, $value);
            }
            foreach($listsFilter as $listf){
                // ta + 1 cho tất cả card đã lấy về và lưu lại
                $listf->index += 1;
                $listf->save();
            }
        }
        $list->index = $request->index;
        $list->save();
        broadcast(new ModifyListPosition($list))->toOthers();
        return $list;
    }
    public function updateTitle(Request $request,Column $list){
        $request->validate([
            "title" => "string|max:255|min:1"
        ]);
        $list->title = $request->title;
        $list->save();
        broadcast(new ModifyListTitle($list))->toOthers();
        return $list;
    }
    public function store(Request $request){
        $request->validate([
            "title" => "string|max:255|min:1",
            "project_ID" => "integer|min:0",
        ]);
        $project = Project::find($request->project_ID);
        $length = count($project->columns);
        $list = new Column();
        $list->title = $request->title;
        $list->index = $length;
        $list->project_ID = $request->project_ID;
        $list->save();
        broadcast(new ListCreated($list));
        return $list;
    }
    // Delete
    public function destroy(Column $column){
        $project_ID = $column->project_ID;
        $lists = Column::where("project_ID", $project_ID)->where("index", ">", $column->index)->get();
        foreach($lists as $item){
            $item->index -= 1;
            $item->save();
        }
        broadcast(new ListDeleted($column))->toOthers();
        $column->delete();
        return response()->json($column);
    }
}
