<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
	    $users = User::all();
		//return $users;
        return view('admin.user.index',compact('users'));
    }
	
	public function show($id)
    {   
	    
        $user = User::find($id);
		//$product = Product::find($id)->where('id', 5)->get();
		//return $product;
        return view('admin.user.show',compact('user'));
    }
	
	public function edit($user_id)
    {   
	    $user = User::find($user_id);
        return view('admin.user.edit',compact('user'));
    }
	
	public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($user_id);
		//return $user;
		$user->update($request->all());
		return redirect()->route('admin.user.index')
                        ->with('success','PhoneBook updated successfully');
    }
	public function type(){
		$user_type = Auth::user()->type;
		return $user_type;
	}
}
