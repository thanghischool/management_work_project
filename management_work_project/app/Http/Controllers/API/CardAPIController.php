<?php

namespace App\Http\Controllers\API;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Events\CardCreated;
use App\Events\ModifyCardPosition;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
            'title' => 'required|string'
        ];
        $request->validate($rule);
        $column = Column::find($request->list_ID);
        $cards_length = count($column->cards);
        $card = new Card;
        $card->list_ID = $request->list_ID;
        $card->index = $cards_length;
        $card->title = $request->title;
        $card->description = "";
        $card->save();
        $project_ID = $column->project_ID;
        broadcast(new CardCreated($project_ID, $card));
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
        $cards = Card::where("list_ID", "=", $request->list_ID)->get();
        $length = count($cards);
        // kiểm tra card có chuyển đổi sang list khác hay không ?
        if($card->list_ID != $request->list_ID && $request->index <= $length){
            // trường hợp card chuyển sang list khác:
            // chuyển tất cả card có index lớn hớn -1
            $oldList = Card::where("list_ID", "=", $card->list_ID)->where("index", ">", $card->index)->get();
            foreach($oldList as $cardL){
                // ta - 1 cho tất cả card đã lấy về và lưu lại
                $cardL->index -= 1;
                $cardL->save();
            }
            // ta thay đổi dữ liệu list_ID của card vì đã chuyển đổi sang list khác
            $card->list_ID = $request->list_ID;
            // lấy dữ liệu của những card nằm trong list mình chuyển tới có index lớn hơn index mình muốn chèn vào list đó
            $cardsFilter = array();
            foreach($cards as $value){
                if ($value->index >= $request->index) array_push($cardsFilter, $value);
            }
            if(count($cardsFilter) != 0) {
                // kiểm tra nếu dữ liệu card lấy về khác 0 thì ta cho tất cả những card lấy về index + 1
                foreach($cardsFilter as $cardf){
                    $cardf->index += 1;
                    $cardf->save();
                }
                $card->index = $request->index;
            } else $card->index = $length;
            // ta cật nhật dữ liệu index của card mình muốn chèn
            $card->save();
        } else if ($request->index < $length){
            // Ngược lại trường hợp card di chuyển index trong local list
            // so sánh index muốn chèn có nhỏ hơn index của card hiện tại hay không
            if($card->index > $request->index){
                // nếu index muốn chèn nhỏ hơn
                // thì ta lấy tất cả card trong local list có index từ index muốn chèn tới (index hiện tại của card - 1)
                $cardsFilter = array();
                foreach($cards as $value){
                    if ($value->index >= $request->index && $value->index < $card->index) array_push($cardsFilter, $value);
                }
                foreach($cardsFilter as $cardf){
                    // ta + 1 cho tất cả card đã lấy về và lưu lại
                    $cardf->index += 1;
                    $cardf->save();
                }
            } else if($card->index < $request->index){
                // Ngược lại nếu index muốn chèn lớn hơn index của card hiện tại thì
                // ta lấy tất dữ liệu của card có index từ (index của card + 1) đến index minh muốn chèn
                $cardsFilter = array();
                foreach($cards as $value){
                    if ($value->index <= $request->index && $value->index > $card->index) array_push($cardsFilter, $value);
                }
                foreach($cardsFilter as $cardf){
                    // ta - 1 cho tất cả card đã lấy về và lưu lại
                    $cardf->index -= 1;
                    $cardf->save();
                }
            }
            // cật nhật vị trí của card muốn chèn
            $card->index = $request->index;
            $card->save();
        }
        $project_ID = $card->column->project_ID;
        broadcast(new ModifyCardPosition($project_ID, $card))->toOthers();
        return $card;
    }

    /**
     * Remove the specified card from database.
     */
    public function destroy(Card $card)
    {
        $list = Card::where("list_ID", "=", $card->list_ID)->where("index", ">", $card->index)->get();
        foreach($list as $item){
            $item->index -= 1;
            $item->save();
        }
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
