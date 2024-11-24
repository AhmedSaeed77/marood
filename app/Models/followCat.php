<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class followCat extends Model
{
    use HasFactory;
    protected $table = "follow_cats";
    protected $guarded = [];
    public function user(){
        return  $this->belongsTo('App\Models\User','user_id');
    }
    public function Cat(){
        return $this->belongsTo('App\Models\Cat','cat_id');
    }
}
