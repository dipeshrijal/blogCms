<?php

namespace blogCms\Http\Controllers\Backend;

use blogCms\Post;
use blogCms\User;

class DashboardController extends Controller
{
    public function index(Post $post, User $user) 
    {
        $posts =  $post->latest('updated_at')->take(5)->get();

        $users = $user->whereNotNull('last_login_at')->latest('last_login_at')->take(5)->get();

        return view('backend.dashboard', compact('posts', 'users'));
    }
}
