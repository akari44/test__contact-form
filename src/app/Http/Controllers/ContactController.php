<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;

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
