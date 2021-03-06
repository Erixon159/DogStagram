@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="rounded-circle" style="height: 200px" src="/storage/{{ $user->profile->image }}" alt="profile_picture">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex align-items-center">
                <h1 class="pr-5 mb-0">{{ $user->username }}</h1>
                @guest
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @else
                    @if (Auth::user()->id === $user->id)
                        <a class="btn btn-primary font-weight-bold" href="/post/create">Add post</a>
                    @else
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endif
                @endguest
            </div>
            <div class="d-flex pt-2">
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-3">
                <div class="font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4 pr-1">
            <a href="{{ '/post/' . $post->id }}">
                <img class="w-100" src="{{ asset('/storage/' . $post->image) }}" alt="{{ $post->caption }}">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
