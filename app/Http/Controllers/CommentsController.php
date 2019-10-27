<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($post_id)
    {
        $data = request()->validate([
            'post_comment' => 'required',
        ]);

        auth()->user()->comments()->create([
            'post_id' => $post_id,
            'content' => $data['post_comment'],
        ]);

        return redirect('/p/' . $post_id);
    }
}
