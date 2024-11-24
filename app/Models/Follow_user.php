<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow_user extends Model
{
    use HasFactory;
    protected $table = "follow_users";
    protected $guarded = [];
    public function follow(){
        return $this->belongsTo('App\Models\User','follow_user_id');
    }
    public function user(){
        return  $this->belongsTo('App\Models\User','user_id');
    }
}
