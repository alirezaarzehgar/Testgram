@extends('layouts.app')

@section('content')
    <div class="container">


        @if ($followings->count() > 0)
            <v-followings-header
                :followings="{{$followings}}"
            ></v-followings-header>
        <hr>
        @endif

        @if ($followings->count() > 0 || $posts->count() > 0)
            @foreach ($posts as $post)
            <v-fullscreen-post
                title="{{$post->title}}"
                user_id="{{$post->user_id}}"
                post_id="{{$post->id}}"
                :images="{{$post->images->pluck('url')}}"
                admin_link="{{$post->user->profile->username}}"
                body="{{$post->body}}"
                post_likes="{{$post->likes->count()}}"
                post_comments="{{$post->comments->count()}}"
            ></v-fullscreen-post>
            @endforeach
        @endif
    </div>

@endsection
