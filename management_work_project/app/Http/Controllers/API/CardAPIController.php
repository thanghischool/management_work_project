<?php

namespace App\Http\Controllers\API;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CardAPIController extends Controller
{

    // public function getAll($id){
    //     return response()->json(Card::where("list_ID", '=', $id)->get());
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'list_ID' => 'required|integer|min:0',
            'index' => 'required|integer|min:0',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ];
        $request->validate($rule);
        $card = new Card;
        $card->list_ID = $request->list_ID;
        $card->index = $request->index;
        $card->title = $request->title;
        $card->description = $request->description;
        $card->save();
        return $card;
    }

    /**
     * Display all data of card (checklists, tasks, comments, log, file) resource.
     */
    public function show(Card $card)
    {
        foreach ($card->checklists as $checklist){
            $tasks = $checklist->tasks;
        }

        foreach ($card->logss as $log){
            $user = $log->user;
        }

        foreach($card->comments as $comment){
            $user = $comment->user;
        }

        return response()->json([
            "files" => $card->files,
            "logs" => $card->logss,
            "comments" => $card->comments,
            "checklists" => $card->checklists,
        ]);
    }
    /**
     * Update description of card
     */
    public function updateDescription(Card $card, Request $request){
        $request->validate([
            'description' => 'required|string'
        ]);
        $card->description = $request->description;
        $card->save();
        return $card;
    }
    /**
     * Update title of card
     */
    public function updateTitle(Request $request, Card $card)
    {
        $request->validate([
            'title' => 'required|max:100'
        ]);
        $card->title = $request->title;
        $card->save();
        return $card;
    }
    // update index of card or list_ID of card
    public function updateIndex(Request $request, Card $card)
    {
        $request->validate([
            'index' => 'integer|min:0',
            'list_ID' => 'integer|min:0'
        ]);
        // kiểm tra card có chuyển đổi sang list khác hay không ?
        if($card->list_ID != $request->list_ID){
            // trường hợp card chuyển sang list khác:
            // ta thay đổi dữ liệu list_ID của card vì đã chuyển đổi sang list khác
            $card->list_ID = $request->list_ID;
            // lấy dữ liệu của những card nằm trong list mình chuyển tới có index lớn hơn index mình muốn chèn vào list đó
            $cards = DB::table("cards")->where("list_ID",'=', $request->list_ID)->where('index', '>=', $request->index)->get();
            if(count($cards) != 0) {
                // kiểm tra nếu dữ liệu card lấy về khác 0 thì ta cho tất cả những card lấy về index + 1
                for($i = 0; $i < count($cards); $i++){
                    $c = Card::find($cards[$i]->id);
                    $c->index += 1;
                    $c->save();
                }
            }
            // ta cật nhật dữ liệu index của card mình muốn chèn
            $card->index = $request->index;
            $card->save();
        } else {
            // Ngược lại trường hợp card di chuyển index trong local list

            // tìm lấy dữ liệu của list
            $column = Column::find($card->list_ID);
            // so sánh index muốn chèn có nhỏ hơn index của card hiện tại hay không
            if($card->index > $request->index){
                // nếu index muốn chèn nhỏ hơn
                // thì ta lấy tất cả card trong local list có index từ index muốn chèn tới (index hiện tại của card - 1)
                $cards = DB::table("cards")->where("list_ID",'=', $column->id)->whereBetween('index',[(int)$request->index,(int) $card->index - 1])->get();
                for($i = 0; $i < count($cards); $i++){
                    $c = Card::find($cards[$i]->id);
                    // ta + 1 cho tất cả card đã lấy về và lưu lại
                    $c->index += 1;
                    $c->save();
                }
            } else if($card->index < $request->index){
                // Ngược lại nếu index muốn chèn lớn hơn index của card hiện tại thì
                // ta lấy tất dữ liệu của card có index từ (index của card + 1) đến index minh muốn chèn
                $cards = DB::table("cards")->where("list_ID",'=', $column->id)->whereBetween('index',[(int) $card->index + 1, (int)$request->index])->get();
                for($i = 0; $i < count($cards); $i++){
                    $c = Card::find($cards[$i]->id);
                    // cật nhật lại index của card đã lấy về
                    $c->index -= 1;
                    $c->save();
                }
            }
            // cật nhật vị trí của card muốn chèn
            $card->index = $request->index;
            $card->save();
        }
        
        return $card;
    }

    /**
     * Remove the specified card from database.
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return $card;
    }
    



    public function cmtstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_id' => 'required|exists:cards,id',
            'content' => 'required',
        ]);

        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }

    public function cmtupdate(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return response()->json($comment, 200);
    }

    public function cmtdestroy($id)
    {
        Comment::destroy($id);
        return response()->json(null, 204);
    }

}
