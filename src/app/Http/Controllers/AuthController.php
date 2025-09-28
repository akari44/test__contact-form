<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function add()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {
        $form = $request -> all();
        User::create($form);

        return redirect('/login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function checkLogin(LoginRequest $request)
    {
        $form = $request->all();
        return redirect('/admin');
    }
}
