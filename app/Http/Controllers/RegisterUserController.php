<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


use App\Models\RegisterUser;


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

    public function registeruser(Request $request)
    {
        $request-> validate([
            'username'  => 'required',   
            'email'     => 'required|email|unique:register_users',
            'password'  => 'required|min:8'
            ]);

            $registeruser = new RegisterUser ();
            $registeruser-> username = $request->username;
            $registeruser-> email = $request->email;
            $registeruser-> password = Hash::make($request->password);

        $reg = $registeruser -> save();
        if ($reg)
        {

            return redirect ('/login.php')->with ('Success', 'Registration Successfull, Please Login');
        } 
        else
        {

            return back ()->with ('Failed', 'Registration Failed');           
        }

    }

    public function loginuser(Request $request)
    {
        $request-> validate([
            'email'     => 'required|email',
            'password'  => 'required|min:8|max:12'
            ]);

            $registeruser = RegisterUser::where('email', '=', $request->email)->first();
            if ($registeruser)
            {
                if (Hash::check($request->password, $registeruser->password))
                    {
                        $request->session()->put('loginId', $registeruser->id);
                        return redirect ('/userdashboard.php')->with ('Success', 'Login Successfull, Welcome');
                    }
                    else
                    {
                        return back ()->with ('Failed', 'Password is incorrect');           
                    }
            } 
            else

            {
                return back ()->with ('Failed', 'Email not found');           
            }
            
        }

        public function userdashboard()
        {
            $data = array();
            if (session::has('loginId'))
            {
                $data = RegisterUser::where('id', '=', session::get('loginId'))->first();
            }
            return view('profile.dashboard', compact('data'));
        }

        public function logout()
        {
            if (session::has('loginId'))
            {
                Session::pull('loginId');
                return redirect ('/login.php');
            }
            
        }

}