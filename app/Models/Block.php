<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Block extends Model
{
    use HasFactory;
    protected $table = "blocks";
    protected $guarded = [];
    public $timestamps=false;
    public function user(){
        return $this->belongsTo(User::class,'blocked_id');
    }
}
