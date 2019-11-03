<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_image' => ['required', 'image', 'max:1999']
        ]);

        if (request()->hasFile('post_image')) {
            $image = request()->file('post_image')->getClientOriginalName();
            $imagePath = time() . '_' . $image;
            request()->file('post_image')->storeAs('public/uploads', $imagePath);
        } else {
            $imagePath = 'default.png';
        }

        auth()->user()->posts()->create([
            'title' => $data['post_title'],
            'content' => $data['post_content'],
            'image' => $imagePath,
        ]);

        return redirect('/u/' . auth()->user()->login);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/u/' . auth()->user()->login);
    }
}
