<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberShipDetailsResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->desc,
            'advantage' => $this->advantage,
            'condition' => $this->condition,
            'packages' => $this->packages->makeHidden(['created_at' , 'updated_at']),
            'questions' => $this->questions->makeHidden(['created_at' , 'updated_at']),
        ];
    }
}
