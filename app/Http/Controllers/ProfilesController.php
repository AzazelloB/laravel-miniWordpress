<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class ProfilesController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('profiles.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the application profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($username)
    {
        $user = User::where('login', $username)->firstOrFail();
        $posts = $this->getPosts($user->posts);

        return view('profiles.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function edit($username)
    {
        $data = request()->validate([
            'user_name' => '',
            'user_bio' => '',
            'user_avatar' => ['', 'image', 'max:1999']
        ]);

        if (request()->hasFile('user_avatar')) {
            $image = request()->file('user_avatar')->getClientOriginalName();
            $imagePath = time() . '_' . $image;
            request()->file('user_avatar')->storeAs('public/uploads', $imagePath);
        } else {
            $imagePath = 'avatar-default.png';
        }

        auth()->user()->profile()->update([
            'name' => $data['user_name'],
            'bio' => $data['user_bio'],
            'avatar' => $imagePath,
        ]);

        return redirect('/u/' . auth()->user()->login);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = auth()->user()->adminOrFail();
        $posts = $this->getPosts(Post::all());

        return view('profiles.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    // WARNING: Probably shouldn't be here
    public function getPosts($posts)
    {
        return $posts->sortByDesc(
            function($post) {
                return $post->created_at;
            }
        );
    }
}
