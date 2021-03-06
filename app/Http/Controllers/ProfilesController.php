<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user)
    {
        $user = User::where('username',$user)->firstOrFail();

        $follows = (Auth::user() ? Auth::user()->following->contains($user->id) : false);

        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(60), function () use($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember('count.followers.' . $user->id, now()->addSeconds(60), function () use($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following.' . $user->id, now()->addSeconds(60), function () use($user) {
            return $user->following->count();
        });

        return view('profiles.index', compact('user', 'follows','postCount', 'followersCount', 'followingCount'));
    }

    public function edit($user)
    {
        $user = User::where('username',$user)->firstOrFail();

        // Tu sa starame o to aby sa stranka nezobrazila niekomu kto na to nema povolenie
        // Vytvorili sme si policy a tu volame cez authorize. Update je metoda a ako vstup je profil
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update($user)
    {
        $user = User::where('username',$user)->firstOrFail();

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => ['nullable','url'],
            'image' => ['nullable','image'],
        ]);

        if(request('image'))
        {
            $imagePath = request('image')->store('profiles', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(500, 500);
            $image->save();

            Auth::user()->profile()->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        } else
        {
            Auth::user()->profile()->update($data);
        }

        return redirect("/profile/$user->username");
    }
}
