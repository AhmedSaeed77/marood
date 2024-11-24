<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menues extends Model
{
    use HasFactory;
    protected $table = "menues";
    protected $guarded = [];
    public function items(){
        return $this->hasMany(menues_items::class,'menues_id')->orderBy('sort','ASC');
    }


}
