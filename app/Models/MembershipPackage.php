<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    use HasFactory;
    protected $table = "membership_packages";
    protected $guarded = [];
    protected $title;
    public function getTitleAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->title_ar;
        }else{
             return $this->title_en;
        }
    } 
    public function member(){
        return $this->belongsTo('App\Models\MemberShip','member_id');
    }
}
