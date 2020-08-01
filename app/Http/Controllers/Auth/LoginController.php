<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public $successStatus = 200;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 

            //UsersPresence::dispatch($userObject);

            return response()->json([
                'token' => Auth::user()->createToken('MyApp')->accessToken,
                'user' => Auth::user()
            ], $this->successStatus);
        } 
        else{ 
            return response()->json(['message' => 'Invalid email or password!'], 401); 
        } 
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
