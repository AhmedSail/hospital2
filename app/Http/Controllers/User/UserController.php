<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function user() {
        return view('Dashboard.User.dashboard');
    }
}
