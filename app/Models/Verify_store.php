<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify_store extends Model
{
    use HasFactory;
    protected $table="verify_model";
    protected $guarded=[];
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
