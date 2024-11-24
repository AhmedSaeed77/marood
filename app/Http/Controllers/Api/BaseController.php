<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Auth;
use App\Models\UserFavourite;
use App\Models\Product;
Use App\Models\Order;
class BaseController extends Controller
{
    
      public function __construct()
    {
        
        $this->guard = "api";
      
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
    	$response = [
            'status' => false,
        ];

        if(!empty($errorMessages)){
            $response['message'] = $errorMessages->first();
        }

        return response()->json($response, $code);
    }
  
    
    
    
    
}