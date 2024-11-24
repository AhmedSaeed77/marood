<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Area extends Model
{
    use HasFactory;
    protected $table = "areas";
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
    public function parent(){
        return $this->belongsTo('App\Models\Area','parent_id');
    }
    public function child(){
        return $this->hasMany('App\Models\Area','parent_id');
    }
    public function children(){
        return $this->hasMany('App\Models\Area','parent_id');
    }

    public function getAllAreas ()
    {
        $sections = new Collection();


        foreach ($this->children as $section) {
            $sections->push($section);
        }

        return $sections;
    }


}
