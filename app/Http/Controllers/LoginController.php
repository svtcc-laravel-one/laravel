<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function login(){
        dump(request()->post('username'));
    }
}

