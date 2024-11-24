<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionForPages extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function parent(){
        return $this->belongsTo('App\Models\questionForPages','parent_id');
    }

}
