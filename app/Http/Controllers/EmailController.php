<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Mail;

use App\Models\Category;
use Illuminate\Support\Facades\Mail as FacadesMail;

class EmailController extends Controller
{
    public function create()
    {
        if (session::has('AdmLogId'))
        {
            Session::pull('AdmLogId');
            $category = Category::All();
            return view('pages.ourcontact', compact('category'));
        }
        else
        {
            $category = Category::All();
            return view('pages.ourcontact', compact('category'));
        }
       
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'subject'=> 'required',
            'content'=> 'required',
        ]);

        $data = [
            'fname' => $request -> fname,
            'lname' => $request -> lname,
            'email' => $request-> email,
            'subject'=> $request-> subject,
            'content'=> $request-> content
        ];
        
        Mail::send('email-template', $data, function($message) use ($data)
        {
            $message->to('dieselphoenix78@gmail.com')
            // $message->to($data['email'])
            ->subject($data['subject']);
        });
        
        return back()->with (['message' => 'Message Successfully Sent!']);
    }
}