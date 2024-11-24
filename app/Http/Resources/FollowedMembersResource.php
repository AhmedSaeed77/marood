<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowedMembersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->follow->id,
            'name' => $this->follow->name,
            'email' => $this->follow->email,
            'phones' => $this->follow->phones,
            'active' => $this->follow->active,
            'description_store' => $this->follow->description_store,
            'avatar' => $this->follow->avatar ? url('public/storage').'/'.$this->follow->avatar : null,
            'cover' => $this->follow->cover ? url('public/storage').'/'.$this->follow->cover : null,
            'profile_url'=>route('profile',$this->follow->id),
            'followers' => count($this->follow->follower),

            'positive_ratings' => $this->follow->ratingAvg,
            'average' => $this->follow->average,
            'count' => $this->follow->count,
            'commission_payed' => $this->follow->commissionPayed(),
            'store_identify' => $this->follow->store_identify,
            'user_posts' => PostResource::collection($this->follow->user_posts) ,
            'average_rate'=>$this->follow->averagerate,
            'rate_number'=>$this->follow->ratesCount,
            'created_at' => $this->follow->created_at->diffForHumans(),
        ];
    }
}
