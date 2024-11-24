<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
      protected $guarded=[];
    protected $table="contacts";
    public function reason(){
        return $this->belongsTo('App\Models\WhyContact','reason_id');
    }
}
