<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $title;
    protected $desc;
    protected $advantage;
    protected $condition;

    public function getTitleAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->title_ar;
        }else{
             return $this->title_en;
        }
    }   
    public function getDescAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->desc_ar;
        }else{
             return $this->desc_en;
        }
    }
    public function getAdvantageAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->advantage_ar;
        }else{
             return $this->advantage_en;
        }
    }
    public function getconditionAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->condition_ar;
        }else{
             return $this->condition_en;
        }
    }
    public function questions(){
        return $this->hasMany('App\Models\questionForPages','member_id');
    }
    public function packages(){
        return $this->hasmany('App\Models\MembershipPackage','member_id');
    }
}
