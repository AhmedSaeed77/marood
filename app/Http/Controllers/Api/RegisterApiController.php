<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\UserPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;

use Carbon\Carbon;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiTrait;


class RegisterApiController extends BaseController
{
    
    use ApiTrait;

     public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','checkCode','sendOtpAgain']]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }
    public function register(Request $request)
    {

       $today = Carbon::today();
        $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'email'=> 'required|email|unique:users,email',
          'password' => 'required|min:6|confirmed',
//          'phone'=>'required|unique:users,phone|max:11'

        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
          $user = new User;
          $user->name = $request['name'];
          $user->email=$request['email'];
          $user->password=Hash::make($request['password']);
//          $user->phone=$request['phone'];
          $user->firebaseToken=$request['firebaseToken'];
          $user->avatar='users/default.png';
          $user->save();
          UserPhone::create([
              'user_id'=>$user->id,
              'number'=>$request['phone']
          ]);
          
          
        //   $credentials =$request->only('email', 'password');
        //  $token = JWTAuth::attempt($credentials);

        //  $use=new UserResource($user);
        // return response()->json([
        // 'status'=>true,
        //     'message' => 'success',
        //     'data' =>['token'=>$token,
        //     'user'=>$use,
        //     ]
        // ], 201);
        
        
       $credentials = $request->only('email', 'password');
        
        $user = User::query()->where('email','=',$request->email)->first();

        $code = rand(100000,999999);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $code,
            'created_at' => Carbon::now()
        ]);

        Mail::to($user->email)->send(new OtpMail($code));
        
        return $this->sendResponse(__('auth.check_code_in_login'),['email' => $request->email,'password' => $request->password],200);

    }
    
    
    public function sendOtpAgain(Request $request){
        
         $validator = Validator::make($request->all(), [
          'email'=> 'required|email|exists:users,email',
          'password' => 'required',

        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        
        
          DB::table('password_resets')->where(['email' => $request->email])->delete();
           
       $credentials = $request->only('email', 'password');
        
        $user = User::query()->where('email','=',$request->email)->first();

        $code = rand(100000,999999);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $code,
            'created_at' => Carbon::now()
        ]);

        Mail::to($user->email)->send(new OtpMail($code));
        
        return $this->sendResponse(__('auth.check_code_resend'),['email' => $request->email,'password' => $request->password],200);

    }
    
    
    
      public function checkCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required',
            'code'=> 'required',
            'password' => 'required'
        ]);
        if($validator->fails()) {

            return  response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()->first()], 422);

        }

        $checkCode = DB::table('password_resets')
            ->where('token','=',$request->code)
            ->where('email','=',$request->email)
            ->first();

        if($checkCode){
           $credentials = $request->only('email', 'password');

           $token = auth('api')->attempt($credentials);
          $user = auth('api')->user();
          $user->update(['firebaseToken' => $request->device_token,'email_verified_at' =>  Carbon::now()]);
          DB::table('password_resets')->where('email',$request->email)->delete();


           return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$token,
            ], 200);

        }else{
            return $this->sendFail('الكود غير صحيح',['email' => $request->email],404);
        }
    }


    
    
    
    
    public function guard()
    {
        return Auth::guard();
    }
}
