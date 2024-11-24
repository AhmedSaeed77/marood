<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowComment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "follow_comments";
   public function user(){
       return $this->belongsTo(User::class,'user_id');
   }
   public function post(){
       return $this->belongsTo('App\Models\Post','post_id');
   }

}
