<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Validation\Rule;

class CommentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'card_ID' => 'required|integer|exists:cards,id', // Ensure card_ID exists in cards table
            'user_ID' => 'required|integer|exists:users,id', // Ensure user_ID exists in users table
            'content' => 'required|string',
        ]);

        return Comment::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $post)
    {
        $this->validate($request, [
            'card_ID' => [
                'nullable',
                'integer',
                Rule::exists('cards', 'id')->where(function ($query) use ($post) {
                    return $query->where('id', '!=', $post->id); // Prevent updating card_ID to same card
                }),
            ],
            'user_ID' => 'nullable|integer|exists:users,id',
            'content' => 'nullable|string',
        ]);

        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $post)
    {
        $post->delete();
    }
}
