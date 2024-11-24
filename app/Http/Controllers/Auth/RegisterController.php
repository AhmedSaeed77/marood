<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use QrCode;
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

    /**
     * Where to redirect users after registration.
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone-code' => ['required'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'avatar'=> ['required', 'image'],
           
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {  
//             if($request->hasFile('avatar')){
//         $str=rand();
//         $result = md5($str);
//         $file =$request['avatar'];
//         $file_name = time() . $result . $file->getClientOriginalName();
//         $file->move(base_path() . '/public/storage/users/' , $file_name);
//   $photo='users/'.$file_name;
//     }else{
//         $photo='users/default.png';
//     }

      $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone-code'].$data['phone'],
            'password' => Hash::make($data['password']),
             'avatar'=>'users/default.png'
               
        ]);
        $url='http://'.$_SERVER['HTTP_HOST'].'/harajElryad/ar/user/'.$user->id.'/profile';
       
        $qr= QrCode::format('svg')
            ->size(200)->errorCorrection('H')
            ->color(4, 115, 192)
            ->generate($url);
          //  dd($qr);
        //  $file_name='qr_users'.$user->id.'_'.$user->name;  
        //  $qr->move(base_path() . '/public/storage/users/' , $file_name);
        // $QR='users/'.$file_name;

        $user->update(['QR'=>$qr]);
        

        return $user;
    }
}
