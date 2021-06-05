@extends('layouts.app')

@section('content')
    <div class="container profile-main">
        <div class="row">
            <div class="profile-left-side">
                <img class="profile-medium" src="{{$user->profile->image->path()}}" alt="">
            </div>

            <div class="col-4">
                <div class="row d-flex justify-content-around mb-3">
                    <h4>{{$user->profile->username}}</h4>

                    @if (Auth::user()->profile->username == $user->profile->username)
                        <div class="mx-2">
                            <a href="{{ route('account.edit', ['account' => $user->id]) }}"><button class="btn border" style="height: 30px">{{ __('local.EditProfile') }}</button></a>
                        </div>
                        <div>
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z"/>
                            </svg>
                        </div>
                    @else
                        <form action="{{route('user.follow', ['username' => $user->profile->username]) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">
                                {{ $followed ? __('local.Unfollow') : __('local.Follow') }}
                            </button>
                        </form>
                    @endif
                </div>

                <div class="row d-flex justify-content-around mb-3">
                    <div>
                        <a>
                            <h6> {{ $user->posts->count() }}  {{ __('local.posts') }}</h6>
                        </a>
                    </div>
                    <div class="mx-2">
                        <v-follower-modal
                            :users="{{$followers}}"
                            title="{{ $user->followers->count() }} {{ __('local.followers') }}"
                        ></v-follower-modal>
                    </div>
                    <div>
                        <v-following-modal
                            :users="{{$followings}}"
                            title="{{ $user->following->count() }} {{ __('local.following') }}"
                        ></v-following-modal>
                    </div>
                </div>

                <div class="col">
                    <div>
                        <h5> {{ $user->name }} </h5>
                    </div>
                    <div>
                        {{ $user->profile->bio }}
                    </div>
                    <div>
                        <a href="{{ $user->profile->website }}">{{ $user->profile->website }}</a>
                    </div>
                </div>

            </div>

        </div>


        <hr>

        <div class="d-flex flex-wrap">
            @foreach ($posts as $post)
                <v-post
                post_id="{{$post->id}}"
                user_id="{{$post->user_id}}"
                title="{{$post->title}}"
                descyption="{{$post->body}}"
                :images="{{ $post->images->pluck('url') }}"
                commentsCount="{{ $post->comments()->count() }}"
                likesCount="{{ $post->likes()->count() }}"
                post_url="{{ route('post.show', ['post'=>$post->id]) }}"></v-post>
            @endforeach
        </div>
    </div>
@endsection
