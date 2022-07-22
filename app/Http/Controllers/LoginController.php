<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {

        $loginData = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        if (! Auth::attempt(['email' => $loginData['email'], 'password' => $loginData['senha'] ])) {
            return redirect()->back()->withErrors("E-mail ou senha inválidos");
        } else {
            return to_route('cliente.index');
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
