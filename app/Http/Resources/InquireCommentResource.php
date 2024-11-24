<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquireCommentResource extends JsonResource
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

            'id' => $this->id,
            'time' => $this->created_at->diffForHumans(),
            'user_name'=>$this->user->name,
            'avatar' =>$this->user->avatar ? url('public/storage').'/'.$this->user->avatar : null,
            'comment' => $this->comment,
        ];
    }
}
