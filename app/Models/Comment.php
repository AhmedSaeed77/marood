<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function parent(){
        return $this->belongsTo('App\Models\Comment','parent_id');
    }
    public function replies(){
        return $this->hasMany('App\Models\Comment','parent_id');
    }

    public function post() {
        return $this->belongsTo(Post::class , 'post_id');
    }
}
