<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Following;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __invoke(string $username)
    {
        $user = $this->fetchUser($username);
        $posts = $this->fetchPosts($username);
        $followed = $this->followed($username);

        $followers = $this->followers($username);
        $followings = $this->followings($username);

        $params = compact(
            'posts', 'user',
            'followed', 'followers',
            'followings'
        );

        return view('account.profile', $params);
    }

    private function fetchPosts(string $username)
    {
        $user = $this->fetchUser($username);

        return $user->posts;
    }

    private function getProfile(string $username)
    {
        $profileId = Profile::where('username', $username)->pluck('id')->first();

        $profile = Profile::findOrFail($profileId);

        return $profile;
    }

    private function fetchUser(string $username)
    {
        $profile = $this->getProfile($username);

        return $profile->user;
    }

    private function followed(string $username)
    {
        $user = $this->fetchUser($username);

        $userId = Auth::user()->id;

        $followersCount = $user->followers()->where('follower_id', $userId)->get()->count();

        return $followersCount > 0;
    }

    private function getFollower(User $user)
    {
        return $user->followers;
    }

    private function followers(string $username)
    {
        $guestUser = $this->fetchUser($username);

        $followers = collect($this->getFollower($guestUser));

        $followers->map(function($follower) {
            return $follower->user->profile;
        });

        return $followers;
    }

    private function getFollowing(User $user)
    {
        return $user->following;
    }

    private function followings(string $username)
    {
        $guestUser = $this->fetchUser($username);

        $followings = collect($this->getFollowing($guestUser));

        $followings->map(function($follower) {
            return $follower->user->profile;
        });

        return $followings;
    }
}
