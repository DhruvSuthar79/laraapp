<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function viewSinglePost(Post $post)
    {
        // echo "<pre>";
        // print_r($post->all());
        // echo "</pre>";
        return view('single-post', ['post' => $post]);
    }

    public function storeNewPost(Request $request)
    {

        // dd($request->all());

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'New post created successfully.');
    }

    public function showCreateForm()
    {
        return view('create-post');
    }
}
