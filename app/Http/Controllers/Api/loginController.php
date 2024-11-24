<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class loginController extends Controller
{    private $provider;
    private $access_token;
    private $token;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


         public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'status'=>false,
                        'message' => __('auth.failed'),
                        'data' =>$token,
                    ], 201);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

          $user = auth('api')->user();
          $user->update(['firebaseToken' => $request->device_token]);
          
          //check if not verified
          if($user->email_verified_at == null){
              
            DB::table('password_resets')->where(['email' => $request->email])->delete();

              
             $user = User::query()->where('email','=',$request->email)->first();
    
            $code = rand(100000,999999);
    
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $code,
                'created_at' => Carbon::now()
            ]);
    
            Mail::to($user->email)->send(new OtpMail($code));
          }

           return response()->json([
                
                'status'=>true,
                'message' => $user->email_verified_at == null  ?  __('auth.check_code_in_login') :  'success',
                 'email_verified_at' => $user->email_verified_at,
                'data' =>$token,
                
            ], 201);
  }



     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth($this->guard)->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=auth($this->guard)->user();
        $user->firebaseToken=null;
        $user->save();
        auth($this->guard)->logout();
        return response()->json(['status'=>true,
        'message' => 'success',
        'data'=>__('site.loguout message'),
        ]
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
    public function guard()
    {
        return Auth::guard();
    }
}
