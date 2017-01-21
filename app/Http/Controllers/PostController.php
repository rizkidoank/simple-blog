<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request){
        if (\Auth::user())
            $posts = Post::orderBy('created_at','desc')->paginate(5);
        else
            $posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(5);
        $title = "Tulisan Terakhir";
        $comments = Comment::all();
        return view('home')->withPosts($posts)->withTitle($title)->withComments($comments);
    }

    public function create(Request $request){
        if ($request->user()->can_post()) {
            $title = "Buat Artikel Baru";
            return view('posts.create')->withTitle($title);
        } else
            return redirect('/')->withErrors('Permission denied');
    }
    public function store(StorePost $request){
        $post = new Post();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = str_slug($post->title);
        $post->author_id = $request->user()->id;
        if ($request->has('save')){
            $post->active = 0;
            $message = "Post saved";
        } else{
            $post->active = 1;
            $message = "Post published";
        }
        $post->save();
        return redirect('edit/'.$post->slug)->withMessage($message);
        return $post;
    }
    public function edit(Request $request,$slug)
    {
        $post = Post::where('slug',$slug)->first();
        $title = "Perbarui Artikel";
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('posts.edit')->with('post',$post)->withTitle($title);
        return redirect('/')->withErrors('you have not sufficient permissions');
    }

    public function show($slug){
        $post = Post::where('slug',$slug)->first();
        if(!$post){
            return redirect('/')->withErrors('Oops! Artikel tidak ditemukan!');
        }
        $comments = $post->comments;
        return view('posts.show')->withPost($post)->with('comments',$comments);
    }
    public function update(Request $request){
        $p_id = $request->input('post_id');
        $post = Post::find($p_id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Post::where('slug',$slug)->first();
            if($duplicate) {
                if($duplicate->id != $p_id)
                    return redirect('/edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
                else
                    $post->slug = $slug;
            }
            $post->title = $title;
            $post->body = $request->input('body');
            if($request->has('save')) {
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = '/edit/'.$post->slug;
            } else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = $post->slug;
            }
            $post->save();
            return redirect("/edit/".$landing)->withMessage($message);
        }
        else
            return redirect('/')->withErrors('you have not sufficient permissions');
    }

    public function delete(Request $request, $id){
        $post = Post::find($id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())){
            $post->delete();
            $data['message'] = "Artikel berhasil dihapus";
        } else{
            $data['error'] = "Permission denied";
        }
        return redirect('/')->with($data);
    }
}
