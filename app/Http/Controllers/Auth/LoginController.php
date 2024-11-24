<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
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
    use AuthenticatesUsers {
        logout as performLogout;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.login');
    }
      public function process_login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('email',$request->email)->first();
        // dd($user);
        if ($auth = auth()->attempt(array('email' => $request['email'], 'password' => $request['password']))) {
            
            if (session()->has('url.intended')) {
                    return redirect(session('url.intended'));
                }
                
                
             session(['url.intended' => null]);


            return redirect()->route('index');

        }else{
            session()->flash('message', __("auth.failed"));
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        $lang=app()->getLocale();
        $this->performLogout($request); // call the original code
        app()->setLocale($lang);
        return redirect()->route('index'); // add the Locale fix for logout
    }
}
