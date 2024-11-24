<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_avatar'=>url('public/storage').'/'.$this->user->avatar,
            'rate_type' => $this->rate_type,
            'recommend' => $this->recommend,
            'notes' => $this->notes,
            'image'=>$this->image?url('public/storage').'/'.$this->image:'',
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at ? $this->updated_at->diffForHumans() :NULL ,
        ];
    }
}
