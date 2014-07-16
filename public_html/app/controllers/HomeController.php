<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	

	public function showWelcome()
	{
		return View::make('hello');
	}
        */
	
	/**
	* Layout yang akan digunakan untuk controller ini
	*/

	 protected $layout = 'layouts.master';

	 public function dashboard()
 	{	
	 $this->layout->content = View::make('dashboard.index')->withTitle('Dashboard');
 	}	

	public function authenticate()
	{	
		// Ambil credentials dari $_POST variable
		$credentials = array(
		'email' => Input::get('email'),
		'password' => Input::get('password'),
		);
	try {
		// authentikasi user
		$user = Sentry::authenticate($credentials, false);
		// Redirect user ke dashboard
		return Redirect::intended('dashboard');
		} catch (Exception $e) {
		// kembalikan user ke halaman sebelumnya (login)
		return Redirect::back();
		}		
	}	
	
	public function logout()
	{		
		// Logout user
		Sentry::logout();
		// Redirect user ke halaman login
		// Asal - return Redirect::to('login');
		return Redirect::to('login')->with('successMessage', 'Anda berhasil logout.');
	}	

}
