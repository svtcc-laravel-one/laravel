<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function info()
    {

        return session('user');
    }
}
