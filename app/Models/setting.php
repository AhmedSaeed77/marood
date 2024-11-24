<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    
      public function getSlugAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['slug'] : $this->attributes['slug_en'];
    }
    

}
