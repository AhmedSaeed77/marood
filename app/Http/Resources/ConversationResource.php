<?php

namespace App\Http\Resources;

use App\Models\Conversation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reciver = $this->user_id == auth('api')->id() ?  User::find($this->follow_user_id) :  User::find($this->user_id);
        $conv = Conversation::query()->find($this->id);
        return [
            'id' => $this->id,
            'receiver' => $reciver->name,
            'receiver_id' => $reciver->id,
            'receiver_image' => $reciver->avatar ? url('storage').'/'.$reciver->avatar : null,
            'last_message' => $this->lastMessage ? ($this->lastMessage->msg_content ?? asset($this->lastMessage->file)) : null,
            'last_message_type' => $this->lastMessage ? $this->lastMessage->file_type : null,
            'last_message_read' => $this->lastMessage ? $this->lastMessage->read : 0,
            'message_not_read' => count($conv->msgs->where('read',0)->where('reciever',auth('api')->user()->id)),
            'created_at' => Carbon::make($this->created_at)->toDateTimeString()
        ];
    }
}
