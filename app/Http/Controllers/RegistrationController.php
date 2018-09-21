<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
    	return view('registration.create');
    }

    public function store()
    {
    	//Validate the form
    	$this->validate(request(), [

    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'required|confirmed'

    	]);

    	//create and save the user  // request(['name', 'email', 'password'])
    	$user = User::create([

            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))

        ]);

    	//Sign them in
    	auth()->login($user);


    	return redirect()->home();


    }
}
