<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function createPost() {
        return view('create-post');
    }

    function savePost(Request $request){
        $postData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $postData['user_id'] = auth()->id();
        $newPost = Post::create($postData);
        return redirect("/post/{$newPost->id}")->with('success', 'New post created');
    }

    function singlePost(Post $post) {
        return view('single-post', ['post' => $post]);
    }

    function deletePost(Post $post){
        $post->delete();
        return redirect('/')->with('success', 'Post has been deleted');
    }

    function editPost(Post $post) {
        return view('edit-post', ['post' => $post]);
    }

    function savedEditPost(Post $post, Request $request) {
        $postData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $post->update($postData);
        return back()->with('success', 'Post has been updated');
    }

    function newApiPost(Request $request) {
        $postData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $postData['user_id'] = auth()->id();
        $newPost = Post::create($postData);
        return $newPost->id;
    }

    function deleteApiPost(Post $post){
        $post->delete();
        return "true";
    }
    
}
