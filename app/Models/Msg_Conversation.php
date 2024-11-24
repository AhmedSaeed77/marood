<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg_Conversation extends Model
{
    use HasFactory;
    
    protected $table = "msg__conversations";
    protected $guarded = [];
    public function Sender(){
        return $this->belongsTo('App\Models\User','sender');
    }
    public function Reciever(){
        return $this->belongsTo('App\Models\User','reciever');
    }
}
