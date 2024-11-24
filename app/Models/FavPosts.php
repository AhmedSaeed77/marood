<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavPosts extends Model
{
    use HasFactory;
    protected $guarded = [];
  public function Post(){
      return $this->belongsTo('App\Models\Post','post_id');
  }
}
