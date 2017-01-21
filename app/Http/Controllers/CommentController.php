<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add(Request $request){
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comment::create($input);
        return redirect('/show/'.$slug)->with('message', 'Comment published');
    }

    public function delete(Request $request, $id){
        $comment = Comment::find($id);
        $post = Post::find($comment->on_post);
        if ($comment && $comment->from_user == $request->user()->id){
            $comment->delete();
            $data['message'] = "Komentar berhasil dihapus";
        } else{
            $data['error'] = "Permission denied";
        }
        return redirect('/show/'.$post->slug)->with($data);
    }
}
