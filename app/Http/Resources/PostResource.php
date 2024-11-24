<?php

namespace App\Http\Resources;

use App\Models\FollowComment;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User_posts;

class PostResource extends JsonResource
{


    use HelperTrait;

    public function toArray($request)
    {
        

        return [
            'id' => $this->id,
             'is_access_comments_delete' => $this->post_user->user_id == auth('api')->id() &&  auth('api')->user()->member_id != null ? 1 : 0,
            'parent_id' => $this->Cat->parent_id,
            'title'=>$this->title,
            'title_ar'=>$this->title_ar,
            'title_en'=>$this->title_en,
            'cat_id'=>$this->cat_id,
            'cat_type'=>$this->Cat->type,
            'area_id'=>$this->area_id,
            'km'=>$this->km,
            'use_status'=>$this->use_status,
            'post_type'=>$this->post_type,
            'fuel_type'=>$this->fuel_type,
            'bank_id'=>$this->bank_id,
            'gear_type'=>$this->gear_type,
            'double'=>$this->double,
            'mobile'=>$this->mobile,
            'post_url'=>route('posts.details',$this->id),
            //'contact'=>$this->contact,
            'Show_on_map'=>$this->Show_on_map,
            'price'=>$this->price,
            'price_type'=>$this->price_type,
            'description'=>$this->description,
            'category_name'=>$this->Cat ?$this->Cat->name:'',
            'area'=>$this->area ? $this->area->name:'',
            'user_name'=>$this->post_user->User->name,
            'user'=>$this->post_user->user_id,
            'user_phone'=>$this->post_user->User->phone,
            'comment'=>$this->comments->count(),
            'avatar' =>$this->post_user->User->avatar ? url('public/storage').'/'.$this->post_user->User->avatar : null,
            'lat'=>$this->lat,
            'lang'=>$this->lng,
            'model'=>$this->model,
            'color'=>$this->color,
            'active'=>$this->active,
            'is_favourite' => (int) $this->checkFav(),
            'contact'=>$this->contact==1?'phone':'message',
            'is_followed' =>  $this->isFollowed()  ,
            'user_followed' => $this->post_user->User->isFollowed()  ,
             'images'=> ImageResource::collection($this->postImages),
             'images_s'=> $this->postImages()->count() >= 1 ? ImageResource::collection($this->postImages) : [asset('public/cap/capimage2.png')],
            'videos'=> $this->postVideos ? ImageResource::collection($this->postVideos) : null,
            'show_comment'=>$this->comment,
            'advertiser_status'=>$this->advertiser_status,
            'commercial_advertiser_number'=>$this->commercial_advertiser_number,
            'street_type'=>$this->street_type,
            //'area'=>$this->area,
            'direction'=>$this->direction,
            'more_details'=>$this->more_details,
            'last_post'=>$this->lastPost?$this->lastPost:null,
            'next_post'=>$this->nextPost?$this->nextPost:null,
            'favs'=>$this->favs->count(),
            'rate'=>$this->post_user->User->userRate?($this->post_user->User->userRate->avg('stars')>5?5:$this->post_user->User->userRate->avg('stars')):0,//average
            'rate_counts'=>$this->post_user->User->userRate?$this->post_user->User->userRate->count():0,
            'keys'=>[
                [
                    'name'=>$this->cat->name,
                    'id'=>$this->cat->id,
                ], [
                    'name'=>$this->cat->parent?$this->cat->parent->name:null,
                    'id'=>$this->cat->parent?$this->cat->parent->id:null,
                ],
            ],
             'street' => $this->street,
            'space' => $this->space,
            'age_of_state' => $this->age_of_state,
            'destination' => $this->destination,
            'street_width' => $this->street_width,
            'rooms_number' => $this->rooms_number,
            'number_of_halls' => $this->number_of_halls,
            'number_of_bathrooms' => $this->number_of_bathrooms,
            'villa_type' => $this->villa_type,
               'details' => $this->details(),
            'additional_options' => $this->getAdditionalOptions(),

            'created_at'=>$this->created_at->diffForHumans(now(),['syntax' => Carbon::DIFF_ABSOLUTE]),
            'updated_at'=>$this->updated_at->diffForHumans(now(),['syntax' => Carbon::DIFF_ABSOLUTE]),
        ];
    }
    
    
    public function getAdditionalOptions()
    {
        $list = [];

        if($this->additional_options != null && is_array($decodedOptions = json_decode($this->additional_options, true)))
        {
            foreach ($decodedOptions as $item){
                $list[] = $item;
            }
        }

        return $list;
    }
    
    
    public function details()
    {
        $attributes = [
            'street' => $this->street,
            'space' => $this->space,
            'age_of_state' => $this->age_of_state,
            'destination' => $this->destination,
            'street_width' => $this->street_width,
            'rooms_number' => $this->rooms_number,
            'number_of_halls' => $this->number_of_halls,
            'number_of_bathrooms' => $this->number_of_bathrooms,
            'villa_type' => $this->villa_type,
        ];
        $list = [];

        foreach ($attributes as $key => $value) {
            if(!is_null($value)){
                $list[$key] = $value;
            }
        }

        $details = implode(', ', array_map(
            function ($key, $value) {

                $key = __('site.'.$key);
                $value =   !is_numeric($value) ? __('site.'.$value) : $value;
                return "$key: $value";
            },
            array_keys($list),
            $list
        ));



    return str_replace(", ", " \n", $details);


    }
}
