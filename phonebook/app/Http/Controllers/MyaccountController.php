<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class MyaccountController extends Controller
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
	    $user_id = Auth::user()->id;
	    $user = User::find($user_id);
		//return $user;
        return view('myaccount.index',compact('user'));
    }
	
	public function edit()
    {   
	    $user_id = Auth::user()->id;
	    $user = User::find($user_id);
        return view('myaccount.edit',compact('user'));
    }
	
	public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($user_id);
		return $user;
		//$user->update($request->all());
       // return redirect()->route('myaccount.index')
                        //->with('success','PhoneBook updated successfully');
    }
}
