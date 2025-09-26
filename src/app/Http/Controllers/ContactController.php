<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm()
    {
        return view('confirm');
    }
    
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function admin()
    {
        return view('admin');
    }

    public function thanks()
    {
        return view('thanks');
    }
    
}
