<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\setting;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{


    public function toArray($request)
    {

        
        
         $date=date('Y-m-d');
         $month=date('m');
          $is_max_length_posts = 0;
           $settingUser=setting::where('name','maxPostInDay')->first()->value;
        $settingUserVim=setting::where('name','maxPostInDayVim')->first()->value;


        if(auth::user()->member_id==null){
            $posts=auth::user()->user_posts()->whereMonth('user_posts.created_at',$month)->count();
        }else{
            $posts=auth::user()->user_posts()->whereDate('user_posts.created_at',$date)->count();
        }
         if(auth::user()->member_id==null){
            if($posts > $settingUser || $posts == $settingUser){
              $is_max_length_posts = 1;
            }else{
                 $is_max_length_posts = 0;
            }

         }else{
            if($posts > $settingUserVim || $posts == $settingUserVim){
                 $is_max_length_posts = 1;
            }else{
             $is_max_length_posts = 0;
            }
         }

     $authenticatedUser = auth('api')->user();
        $chatCount = 0;
        $notificationCount = 0;

        if ($authenticatedUser) {
            $chatCount = $authenticatedUser->recieveMsg->where('read', 0)->count();
            $notificationCount = $authenticatedUser->unreadnotifications
                ->whereIn('type', ["App\Notifications\commentNotification"])
                ->count();
                
        }
        
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phones' => $this->phones,
            'is_max_length_posts' => $is_max_length_posts,
            'active' => $this->active,
            'description_store' => $this->description_store,
            'avatar' => $this->avatar ? url('public/storage').'/'.$this->avatar : null,
            'cover' => $this->cover ? url('public/storage').'/'. $this->cover : null,
            'profile_url'=>route('profile',$this->id),
            'followers' => count($this->follower),
            'positive_ratings' => $this->ratingAvg,
            'average' => $this->average,
            'count' => $this->count,
            'commission_payed' => $this->commissionPayed(),
            'store_identify' => $this->store_identify,
            'user_posts' => PostResource::collection($this->user_posts) ,
            'average_rate'=>$this->averagerate->avg('stars'),
            'rate_number'=>$this->averagerate->count(),
              'chat_count' => $chatCount,
            'notification_count' => $notificationCount,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
