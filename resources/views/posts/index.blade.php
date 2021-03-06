@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <div class="d-flex align-content-center pb-2">
                    <div class="pr-3 pl-1">
                        <img src="/storage/{{ $post->user->profile->image }}" alt="{{ $post->user->username }}" class="rounded-circle w-100" style="height: 40px;">
                    </div>
                    <div class="font-weight-bold">
                        <a href="/profile/{{ $post->user->username }}">
                            <span style="line-height: 40px;" class="dark-text">{{ $post->user->username }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/profile/{{ $post->user->username }}">
                    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->caption }}">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <p class="pt-1 pb-3 pl-1">
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->username }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-6 offset-3 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
