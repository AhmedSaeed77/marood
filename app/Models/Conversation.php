<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Conversation extends Model
{
    use HasFactory;
    protected $table = "conversations";
    protected $guarded = [];
    public function UserSend(){
        return $this->belongsTo('App\Models\User','user_id');
    } public function Userreciev(){
        return $this->belongsTo('App\Models\User','follow_user_id');
    }
    public function msgs(){
        return $this->hasMany('App\Models\Msg_Conversation','conv_id');
    }
    public function RecieveMsg(){
        return $this->hasMany('App\Models\Msg_Conversation','conv_id')->where('sender','!=',Auth::user()->id)->where('read',0)->orderBy('created_at','desc');
    }

    public function lastMessage() {
        return $this->hasOne('App\Models\Msg_Conversation' , 'conv_id')->orderByDesc('created_at');
    }
}
