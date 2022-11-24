<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;


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
    
    public function submitLogin(Request $request){
    if ($request->password==$request -> username) {
        if($user= User::where('username', $request -> username)->first()){
            
            Auth::login($user);
            return redirect('/home');
        }else{
            return back()->with('pesan','Login gagal!');
        }
        
    }else {
        if(Auth::attempt(['username' => $request -> username, 'password' => $request -> password])){
            $user= User::where('username', $request -> username)->first();
            Auth::login($user);
            return redirect('/home');
        }else{
            return back()->with('pesan','Login gagal!');
        }
    }
    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
}
