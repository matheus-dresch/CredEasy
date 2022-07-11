<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index(Request $request)
    {
        return view('signup.index');
    }
}
