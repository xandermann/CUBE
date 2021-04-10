<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function getForm()
	{
		return view('user');
	}

	public function postForm(EmailRequest $request)
	{
		$user = new User;
		$user->user = $request->input('user');
		$user->save();
		
		return view('user_ok');
	}

}
