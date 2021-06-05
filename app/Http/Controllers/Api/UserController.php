<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(string $username = null)
    {
        if (empty($username)) {
            return [];
        }

        return Profile::where('username', 'LIKE', '%' . $username . '%')->get();
    }
}
