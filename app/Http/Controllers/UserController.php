<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function info()
    {
        $user = \Auth::user();

        return view('user.info', compact('user'));
    }
}
