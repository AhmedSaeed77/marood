<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

Trait ApiTrait
{

    public function sendResponse($message , $data , $status = 201): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ],$status);
    }

    public function sendFail($message , $data , $status = 201): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ],$status);
    }

    public function sendMessageResponse($message , $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ],$status);
    }

    public function sendFailedMessage($message , $status = 422): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ],$status);
    }

    public function responseValidationJsonFailed($message = "Fail")
    {
        return response()->json([
            "success" => false,
            "status" => 200,
            "message" => $message,
        ], 200);
    }

    public function returnValidationError($validator){
        return $this->responseValidationJsonFailed(011, $validator->errors());
    }
}
