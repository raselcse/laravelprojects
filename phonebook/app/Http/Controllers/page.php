<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class page extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.home');
    }
	public function about()
    {
        return view('page.about');
    }
	
	public function contacts()
	{
		return view('page.contacts');
	}
	
	public function signature()
	{
		return view('page.signature.blade.php');
	}
}
