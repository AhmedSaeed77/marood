<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menues_items extends Model
{
    use HasFactory;
    protected $table = "menues_items";
    protected $guarded = [];
    protected $photo;
    public function getNameAttribute($value)
    {
        if(\App::getLocale()=='ar')
        {
            return $this->show_name_ar;
        }else{
             return $this->show_name_en;
        }
    }
    public function getPhotoAttribute($value)
    {
        return $this->cat->photo?url('public/storage').'/'.$this->cat->photo:'';
    }
    public function cat(){
        return $this->belongsTo('\App\Models\Cat','cat_id');
    }
    public function child(){
        return $this->hasMany('App\Models\Cat','parent_id')->where('show',1);
    }
    public function has_child(){
        return $this->cat->child->count()>0;
    }

}
