<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatesResource extends JsonResource
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
                    'id'=>$this->id,
                    'user_name'=>$this->user->name,
//                    'user_avatar'=>$this->user->avatar,
            'user_avatar' => $this->user->avatar ? url('public/storage').'/'.$this->user->avatar : null,
            'rate_type'=>$this->rate_type,
                    'recommend'=>$this->recommend,
                    'rate_for_userid'=>$this->rate_for_userid ,
                    'notes'=>$this->notes,
                    'stars'=>$this->stars,
                    'image'=>$this->image,
                    'created_at'=>$this->created_at,
                    'updated_at'=>$this->updated_at,

        ];
    }
}
