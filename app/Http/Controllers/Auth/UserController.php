<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function printAllUsers()
    {
        $users = User::all();
        return view('auth.users')->with("users", $users);
    }
}
