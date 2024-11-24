<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Cat extends Model
{
    use HasFactory;
    protected $table = "cats";
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
        return $this->belongsTo('App\Models\Cat','parent_id');
    }

    public function child(){
        return $this->hasMany('App\Models\Cat','parent_id')->where('show',1);
    }

    public function children(){
        return $this->child()->with('children');
    }

    public function has_child(){
        return $this->child->count()>0;
    }


    public function getAllCats ()
    {
        $sections = new Collection();
        foreach ($this->children as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllCats());
        }
        return $sections;
    }

    public function posts() {
        return $this->hasMany('App\Model\Post' , 'cat_id');
    }
}
