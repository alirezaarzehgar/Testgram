@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h2>{{$post->title}}</h2>
        </div>

        <div>
            <v-slider
            user_id="{{$post->user_id}}"
            post_id="{{$post->id}}"
            :images="{{$images}}"></v-slider>
        </div>

        <div>
            <v-like-comment
                post_id="{{$post->id}}"
                likes="{{$post->likes->count()}}"
                comments="{{$post->comments->count()}}"
                ></v-like-comment>
        </div>

        <div class="mt-5">
            <p>{{$post->body}}</p>
        </div>

        <div>
            <form class="col-1" action="{{ route('post.comment.store', ['id' => $post->id]) }}" method="POST">
                @csrf
                <textarea class="my-3" name="body" id="body" cols="100" rows="5" placeholder="{{__('local.Comment')}}"></textarea>
                <button class="btn btn-primary">{{__('local.submit')}}</button>
            </form>
        </div>

        <div id="comments">
            @foreach ($comments as $comment)
                <v-comment
                    text="{{ $comment->body }}"
                    owner="{{ $comment->user->name }}"
                    user_profile="{{ $comment->user->profile->username }}">

                </v-comment>
            @endforeach
        </div>
    </div>
@endsection
