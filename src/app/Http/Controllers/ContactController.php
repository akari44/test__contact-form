<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(
            'user_id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',);

        $contact['tel'] = $request->input('tel-1') . '-' . $request->input('tel-2') . '-' . $request->input('tel-3');

        $category = Category::find($contact['category_id']);
        $contact['category_name'] = $category ? $category->content : '';
        
        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        if ($request->input('action') === 'back') 
            {
                return redirect('/')->withInput();
            }

        $contact = $request->only(
            'user_id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',);

            Contact::create($contact);

            return redirect('thanks');
    
    }

    public function login()
    {
        return view('auth.login');
    }

    public function admin()
    {
         $contacts = Contact::paginate(7);

        return view('admin', compact('contacts'));

    }

    public function thanks()
    {
        return view('thanks');
    }
    
}
