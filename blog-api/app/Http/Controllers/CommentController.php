<?php

namespace App\Http\Controllers;

use App\Jobs\SendCommentNotification;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Events\CommentAdded;

class CommentController extends Controller
{
    public function allComments()
    {
        $data = ['comments' => Comment::select('*')->get()];
        return response()->json($data);
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $comment = new Comment();

        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json(['status' => 1, 'message' => 'Your comment has been successfully added.'], 201);
    }
}
