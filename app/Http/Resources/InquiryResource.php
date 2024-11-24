<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquiryResource extends JsonResource
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
            'category_id' => $this->category->id,
            'category_name' => $request->header('X-localization') == 'ar' ? $this->category->name_ar : $this->category->name_en,
            'inquiry_url' => url('api/inquiries/show/'.$this->id),
            'user_id' => $this->user->id,
            'time' => $this->created_at->diffForHumans(),
            'user_name'=>$this->user->name,
            'avatar' =>$this->user->avatar ? url('public/storage').'/'.$this->user->avatar : null,
            'details' => $this->details,
            'images' => $this->images(),
            'commentsCount' => $this->commentsCount(),
            'lovesCount' => $this->lovesCount(),
            'comments' => InquireCommentResource::collection($this->comments),
            'isLove' => $this->isLove() ? 1 : 0,


        ];
    }
}
