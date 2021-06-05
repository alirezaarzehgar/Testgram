<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'prof']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $followings = $this->followingsProfile();
        $posts = $this->fetchPosts();

        return view('home', compact('followings', 'posts'));
    }

    private function fetchFollowings()
    {
        $guestUser = Auth::user();

        return $guestUser->following;
    }

    private function followingsProfile()
    {
        $guestUser = Auth::user();

        $following = collect($guestUser->following);

        return $following->map(function($following) {
            return $following->user->profile;
        });
    }

    private function getFollowingsId()
    {
        $followings = collect($this->fetchFollowings());

        $followings = $followings->map(function($following) {
            return $following->user->id;
        });

        return $followings->flatten()->toArray();
    }

    private function getPostsWithIds(array $usersId)
    {
        return Post::whereIn('user_id', $usersId)->get();
    }

    private function fetchPosts()
    {
        $adminUserId = Auth::user()->id;

        $usersId = $this->getFollowingsId();

        $usersId[] = $adminUserId;

        $posts = collect($this->getPostsWithIds($usersId));

        $posts->map(function($post) {
            return [
                $post->images,
                $post->likes,
                $post->comments,
                $post->user,
            ];
        });

        return $posts;
    }
}

;
