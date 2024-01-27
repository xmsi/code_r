<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	public function index(){
		return view('login.index');
	}

	public function login(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'password' => 'required|min:6',
		]);

		$user_data = array(
			'name' => $request->get('name'),
			'password' => $request->get('password')
		);



		if(Auth::attempt($user_data)){
			return redirect('/admin');
		} else {
			return back()->with('error', 'Неправильно введены данные');
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
