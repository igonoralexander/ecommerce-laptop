<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


use App\Models\User;


class RegisterUserController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function registration()
    {
        return view('pages.register');
    }    

}