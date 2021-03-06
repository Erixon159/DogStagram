@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->caption }}">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-content-center">
                    <div class="pr-3">
                        <img src="/storage/{{ $post->user->profile->image }}" alt="{{ $post->user->username }}" class="rounded-circle w-100" style="height: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold d-flex align-items-center">
                            <a href="/profile/{{ $post->user->username }}">
                                <span class="dark-text">{{ $post->user->username }}</span>
                            </a>
                            <span class="font-weight-bold pl-2 pr-2">ꞏ</span>
                            <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        </div>
                    </div>
                </div>
                <hr>
                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->username }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
