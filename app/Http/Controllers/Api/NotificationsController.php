<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    use ApiTrait;
    public function index() {
       $notifications = Notification::where([
            'notifiable_id' => Auth::user()->id,
            'type' => "App\Notifications\commentNotification"
        ])->latest()->get();

        foreach ($notifications as $notification) {
            $notification->update([
                'read_at' => Carbon::now()
            ]);
        }
        return $this->sendResponse('success' , NotificationResource::collection($notifications));
    }

    public function show($id) {
        $not = Notification::find(json_decode($id));
        if (!$not)
            return $this->sendMessageResponse('Not Found');
        $not->update([
            'read_at' => Carbon::now()
        ]);
        return $this->sendResponse('success' , NotificationResource::make($not));
    }

    public function destroy($id) {
        Notification::find(json_decode($id))->delete();
        return $this->sendMessageResponse(__('site.Notification Deleted'));
    }

    public function deleteAll() {
        Notification::where([
            'notifiable_id' => Auth::user()->id,
        ])->delete();
        return $this->sendMessageResponse(__('site.Deleted All Notifications'));
    }
}
