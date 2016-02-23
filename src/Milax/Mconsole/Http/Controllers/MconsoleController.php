<?php

namespace Milax\Mconsole\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Milax\Mconsole\Http\Controllers\CMSController;

use Auth;

class MconsoleController extends CMSController
{
	
	protected $uri = '/mconsole';
	
	/**
	 * Display mconsole index page.
	 * 
	 * @access public
	 * @return Response
	 */
	public function index()
	{
		return view('mconsole::app');
	}
	
	/**
	 * Display mconsole login page.
	 * 
	 * @access public
	 * @return Response
	 */
	public function login()
	{
		return view('mconsole::auth.login');
	}
	
	/**
	 * Login attempt request.
	 * 
	 * @access public
	 * @param Request $request
	 * @return Response
	 */
	public function auth(Request $request)
	{
		if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')]))
			return redirect()->back();
		else
			return redirect()->back()->withErrors(['INVALID PASSWORD']);
	}
	
	/**
	 * Logout.
	 * 
	 * @access public
	 * @return redirect
	 */
	public function logout()
	{
		Auth::logout();
		return redirect('/mconsole');
	}

}
