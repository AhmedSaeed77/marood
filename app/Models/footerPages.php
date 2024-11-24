<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footerPages extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $name;
    public function getNameAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->name_ar;
        }else{
             return $this->name_en;
        }
    }
    public function questions(){
        return $this->hasMany('App\Models\questionForPages','page_id');
    }

}
