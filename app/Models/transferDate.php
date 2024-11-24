<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transferDate extends Model
{
    use HasFactory;
    protected $table = "transfer_dates";
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

}
