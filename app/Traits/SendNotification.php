<?php

namespace App\Traits;
use App\Models\Conversation;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\JsonResponse;


trait SendNotification
{

    public function sendFirebaseNotificationChat($fcms,$chatId,$description,$userId,$username)
    {
        

        $title = "New Notification";
       $credentialsFilePath = Http::get(asset('public/json/maarod-c04bb-2788dd2f1018.json'));

        $client = new GoogleClient();
        
        try {
            $client->setAuthConfig($credentialsFilePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->useApplicationDefaultCredentials();
            $client->fetchAccessTokenWithAssertion();
            $token = $client->getAccessToken();
            $access_token = $token['access_token'];
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get access token: ' . $e->getMessage()
            ], 500);
        }
        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/maarod-c04bb/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging

        $results = [];
        foreach ($fcms as $fcm) {

            $data = [
                "message" => [
                    "token" => $fcm,
                    "notification" => [
                        "title" => $title,
                        "body" => $description,
                    ],
                    "data" => [
                        "title" => (string)$chatId,
                        "body" => $description,
                        "user_id" => (string)$userId,
                        "show" => "0",
                        "username" => $username
                    ]
                ]
            ];
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            $response = curl_exec($ch);
            $err = curl_error($ch);
            if ($err) {
                $results[] = [
                    'token' => $fcm,
                    'error' => 'Curl Error: ' . $err
                ];
            } else {
                $results[] = [
                    'token' => $fcm,
                    'response' => json_decode($response, true)
                ];
            }
        }
        curl_close($ch);

        return response()->json([
            'message' => 'Notifications have been sent',
            'results' => $results
        ]);
    }


    public function commentAddPost($fcm,$postId,$description,$userId): JsonResponse
    {
        $title = "New Notification";

        $credentialsFilePath = Http::get(asset('public/json/maarod-c04bb-2788dd2f1018.json'));
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,
                ],
                "data" => [
                    "title" => $title,
                    "body" => $description,
                    "post_id" => $postId,
                    "show" => "1",
                    "user_id" => (string)$userId

                ]
            ]
        ];
        $payload = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/maarod-c04bb/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
    }

}
