<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function getDashboard()
    {
//        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        $test = function ($test) {
            return $test;
        };

//        return view('dashboard', ['posts' => $posts, 'test' => $test]);
        return view('dashboard', compact('posts'));
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max: 1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an Error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post Successfully Created';
        }

        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
//        return redirect()->route('dashboard')->with(['message' => 'Deleted successfully!']);
        return response()->json(['message' => 'Deleted successfully!'], 200);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);

        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();

        return response()->json(['new_body' => $post['body']], 200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $isLike = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();

        if ($like) {
            $stored_like = $like->like;
            $update = true;
            if ($stored_like == $isLike) {
                $like->delete();
                return null;
            }
        } else {
            $like = New Like();
        }
        $like->like = $isLike;
        $like->user_id = $user->id;
        $like->post_id = $post_id;

        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}