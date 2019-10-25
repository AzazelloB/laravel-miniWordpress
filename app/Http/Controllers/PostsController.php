<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
