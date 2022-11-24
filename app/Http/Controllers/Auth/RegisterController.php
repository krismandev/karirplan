<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\modelJabatan;
use App\modelPendidikan;
use App\fungsiGlobal;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm() {
        $jabatan    = modelJabatan::where("golongan","!=","IV/e")->get();
        $pendidikan = modelPendidikan::all();
        return view("auth.register")
            ->with("jabatan",$jabatan)
            ->with("pendidikan",$pendidikan);
    }

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6',
            'tglLahir'   => 'required',
            'tglJadi'    => 'required',
            'pendidikan' => 'required',
            'jabatan'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'tglLahir' => $data['tglLahir'],
            'id_jab'   => fungsiGlobal::decrypt($data['jabatan']),
            'id_pend'  => fungsiGlobal::decrypt($data['pendidikan']),
            'tglJadi'  => $data['tglJadi'],
            'serdos'   => $data['serdos'],
        ]);
    }
}
