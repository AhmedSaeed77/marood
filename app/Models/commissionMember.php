<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commissionMember extends Model
{
    use HasFactory;
    protected $table = "commission_members";
    protected $guarded = [];
    protected $desc;
    protected $name;
    public function getDescAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->desc_ar;
        }else{
             return $this->desc_en;
        }
    }
    public function getNameAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->name_ar;
        }else{
             return $this->name_en;
        }
    }
    public function cat(){
        return $this->belongsTo(Cat::class,'cat_id');
    }
}
