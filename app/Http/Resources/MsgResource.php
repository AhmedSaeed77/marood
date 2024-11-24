<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MsgResource extends JsonResource
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
            'file_type' => $this->file_type,
            'me' => $this->sender == auth('api')->id() ? 1 : 0,
            'message' => $this->file != null ? asset($this->file) : $this->msg_content,
            'created_at' => Carbon::make($this->created_at)->toDateTimeString(),
        ];
    }
}
