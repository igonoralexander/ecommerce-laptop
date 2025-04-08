<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileManagementController extends Controller
{
    //
    public function ProfileManagement()
    {
        $user = auth()->user();
        return view('profile.profile-management', compact('user'));
    }


    public function ChangePassword()
    {
        return view('profile.change-password');
    }
}
