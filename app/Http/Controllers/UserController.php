<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function info()
    {
        $user = \Auth::user();
        return view('user.info', compact('user'));
    }
}
