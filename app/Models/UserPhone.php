<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    use HasFactory;
    protected $table='user_phone';
    public $timestamps=false;
    protected $guarded =[];
    public $hidden=['user_id'];
    
    
     // Accessor to format the phone number
    public function getNumberAttribute($value)
    {
        

        return (int) $value;
    }
}
