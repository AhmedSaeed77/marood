<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_posts extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "user_posts";
      public function User(){
          return $this->belongsTo('App\Models\User','user_id');
      }
      public function post(){
        return $this->belongsTo('App\Models\Post','post_id');
      }
}
