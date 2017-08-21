<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->subject = 'Your Password Reset Link'; //  < --JUST ADD THIS LINE
        $this->middleware('guest');
    }
	
	public function notify(Request $request)
    {
    // Actually email address will come from current session
    // Not sure if I can instantiate Request afresh and do merge. Can I?
        $request->merge(['email' => 'correct@email.address']);
        dump( $this->sendResetLinkEmail($request) );
    }
}
