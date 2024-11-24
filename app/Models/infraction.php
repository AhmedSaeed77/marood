<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infraction extends Model
{
    use HasFactory;
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

}
