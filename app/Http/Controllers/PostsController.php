<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Auth::user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        Auth::user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->username);
    }

    public function show(Post $post)
    {
        $user = User::where('username',$post->user->username)->firstOrFail();
        $follows = (Auth::user() ? Auth::user()->following->contains($user->id) : false);

        return view('posts.show', compact('post','user', 'follows'));
    }
}
