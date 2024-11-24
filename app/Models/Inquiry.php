<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Cat::class,'cat_id','id');
    }

    public function images(): array
    {
        if($this->images != null){

            $images = [];
            foreach (json_decode($this->images,true) as $image) {

                $images[] = asset($image);
            }

            return $images;
        }else{

            return [];
        }


    }

    public function comments(): HasMany
    {
        return $this->hasMany(InquireComment::class,'inquire_id','id');
    }

    public function loves(): HasMany
    {
        return $this->hasMany(FavInquire::class,'inquire_id','id');
    }


    public function commentsCount(): int
    {
        return $this->comments()->count();
    }

    public function lovesCount(): int
    {
        return $this->loves()->count();

    }


    public function isLove(): bool
    {
        return $this->loves()->where('inquire_id','=',$this->id)->where('user_id','=',auth('api')->id())->exists();

    }


}
