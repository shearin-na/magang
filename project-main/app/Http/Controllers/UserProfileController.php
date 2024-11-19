<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('Laravel-Examples.User-Profile');
    }
}

