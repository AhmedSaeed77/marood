<?php

namespace App\Http\Controllers\Api\ResetPassword;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\User;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{

    use ApiTrait;
    public function forgetPassword(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email'=> 'required|email|exists:users,email',
        ]);
        if($validator->fails()) {

            return  response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()->first()], 422);

        }

        $user = User::query()->where('email','=',$request->email)->first();

        $code = rand(100000, 999999);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $code,
            'created_at' => Carbon::now()
        ]);

        Mail::to($user->email)->send(new ForgetPasswordMail($code));

        return $this->sendResponse('تم ارسال كود خاص لاستعاده كلمه المرور علي البريد الالكتروني',['email' => $request->email],200);

    }


    public function checkCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'code'=> 'required',
        ]);
        if($validator->fails()) {

            return  response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()->first()], 422);

        }

        $checkCode = DB::table('password_resets')
            ->where('token','=',$request->code)
            ->where('email','=',$request->email)
            ->first();

        if($checkCode){
            return $this->sendResponse('الكود صحيح يرجي المتابعه',['email' => $request->email],200);

        }else{
            return $this->sendFail('الكود غير صحيح',['email' => $request->email],404);
        }
    }


    public function resetPassword(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email'=> 'required|email|exists:users,email',
            'password'=> 'required|min:8|confirmed',
        ]);
        if($validator->fails()) {

            return  response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()->first()], 422);

        }

        $checkCode = DB::table('password_resets')
            ->where('email','=',$request->email)
            ->first();

        if(!$checkCode){
            return $this->sendFail('البيانات غير موجوده',[],404);

        }

        $user = User::query()->where('email','=',$request->email)->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);


        DB::table('password_resets')->where('email',$request->email)->delete();

        return $this->sendResponse('تم تغيير كلمه المرور بنجاح',[],200);

    }

}
