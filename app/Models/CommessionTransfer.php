<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommessionTransfer extends Model
{
    use HasFactory; 
    protected $table = "commession_transfers";
    protected $guarded = [];
    public function Bank(){
        return $this->belongsTo('App\Models\HarajBank','bank_id');
    }
    public function date(){
        return $this->belongsTo('App\Models\transferDate','timeOfTransfer');
    }
    public function post(){
        return $this->belongsTo('App\Models\Post','post_number');
    }
    public function member(){
        return $this->belongsTo('App\Models\MemberShip','package_id');
    }
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
