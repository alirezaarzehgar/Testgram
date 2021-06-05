<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function follow(string $username)
    {
        if ($this->followed($username)) {
            $this->unfollowUser($username);
            $this->deleteFollowing($username);
        } else {
            $this->followUser($username);
            $this->addFollowing($username);
        }

        return redirect()->route('profile', ['username' => $username]);
    }

    private function getProfile(string $username)
    {
        return Profile::where('username', $username)->get()->first();
    }

    private function getUser(string $username)
    {
        $profile = $this->getProfile($username);

        $profileId = $profile->user->id;

        $user = User::find($profileId);

        return $user;
    }

    private function followed(string $username)
    {
        $adminUser = Auth::user();

        $guestUser = $this->getUser($username);

        $guestUserId = $guestUser->id;

        $followings = $adminUser->following()->where('following_id', $guestUserId)->get();

        return $followings->count() > 0;
    }

    private function addFollowing(string $username)
    {
        $adminUser = Auth::user();

        $guestUser = $this->getUser($username);

        $userId = $guestUser->id;

        $fol = $adminUser->following()->create(['following_id' => $userId]);
    }

    private function followUser(string $username)
    {
        $user = $this->getUser($username);

        $userId = Auth::user()->id;

        $user->followers()->create(['follower_id' => $userId]);
    }

    private function deleteFollowing(string $username)
    {
        $adminUser = Auth::user();

        $guestUser = $this->getUser($username);

        $userId = $guestUser->id;

        $adminUser->following()->where('following_id', $userId)?->delete();
    }

    private function unfollowUser(string $username)
    {
        $adminUser = Auth::user();

        $guestUser = $this->getUser($username);

        $userId = $adminUser->id;

        $guestUser->followers()->where('follower_id', $userId)->delete();
    }

}
