<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $datas = $request->only([
            'email',
            'password'
        ]);

        $validator = $this->validator($datas);

        $remember = $request->input('remember', false);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($datas, $remember)) {
            return redirect()->route('admin');
        } else {
            $validator->errors()->add('password', 'Email e/ou senha está errado!');

            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function validator(array $datas)
    {
        return Validator::make($datas, [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:4'
        ]);
    }
}
