<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $guarded = [];
    protected $title;
    public $timestamps=true;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $slug = preg_replace('/\s+/', '-', trim($post->title_ar));
            $slug = preg_replace('/[^\p{Arabic}\p{L}\p{N}\s-]/u', '', $slug);

            $post->slug = $slug;
        });
    }

    public function getTitleAttribute($value)
    {
        if(\App::getLocale()=='ar') {
            return $this->title_ar;
        }else{
             return $this->title_en;
        }
    }
//    public function getPriceTypeAttribute($val){
//        if($val==0){
//            return __('site.som');
//        }else{
//            return __('site.price');
//        }
//    }
    public function scopeFilter($query){
        if (\request()->has('category')){
            $categoryChildren = Cat::find(\request('category'))->getAllCats()->pluck('id');
            $categoryChildren->push(\request('category'));
            $query->orWhereIn('cat_id' , $categoryChildren);
         

        }
        if (\request()->has('area')) {
            $areass=[];
            if(request('area')){
            foreach(request('area') as $area){
            $areas = Area::find($area)->getAllAreas()->pluck('id')->toArray();
            $areass=array_merge($areass,$areas);
             array_push($areass,$area);
               }

            }

            $query->whereIn('area_id', $areass);
        }
        if (request()->has('search')){
            $query->where('title_ar' , 'LIKE' , '%' . request('search') . '%')
                    ->orWhere('title_en' , 'LIKE' , '%' . request('search') . '%');
        }
        if (request()->has('model')){
            $query->where('model' , request('model'));
        }
        if (request('image')==1){
            $query->whereHas('images',function ($query){
                return $query->where('image', '!=',null);
            });

        }


       if (auth('api')->check()){
           $blocked_ids=auth('api')->user()->block_users->pluck('blocked_id');
           $query->whereHas('post_user',function ($q) use ($blocked_ids){
               $q->whereNotIn('user_id',$blocked_ids);
           });
       }


        $query->where('active',1)->orderBy('created_at',\request('order')??'desc');


        return $query;
    }


    public function checkFav() :bool {
        if (! Auth::guard('api')->user())
            return 0;
        $exists = FavPosts::where([
            'user_id'=>Auth::guard('api')->user()->id ,
            'post_id' => $this->getKey()
            ])->exists();
        if($exists)
            return 1;

        return 0;
    }

    public function isFollowed(){
        $followed = 0;
        $followedOrNot = 0;
        if (Auth::guard('api')->user()){
            $followedOrNot = FollowComment::where([
                'post_id' => $this->getKey(),
                'user_id' => Auth::guard('api')->user()->id
            ])->exists();
        }
        $followedOrNot ? $followed = 1 : $followed = 0;
        return $followed;
    }

    public function Cat(){
        return $this->belongsTo('App\Models\Cat','cat_id');
    }
    public function area() {
        return $this->belongsTo('App\Models\Area' , 'area_id');
    }

    public function images(){
        return $this->hasMany('App\Models\PostImages','post_id')->orderBy('sort');
    }
    public function favs(){
        return $this->hasMany('App\Models\FavPosts','post_id');
    }
    public function post_user(){
        return $this->hasOne('App\Models\User_posts','post_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment','post_id');
    }

    public function parentComments(){
        return $this->hasMany('App\Models\Comment','post_id')->whereNull('parent_id');
    }

    public function postImages(){
        return $this->hasMany('App\Models\PostImages','post_id')->where('type' , 0)->orderBy('sort');
    }
    public function postVideos(){
        return $this->hasMany('App\Models\PostImages','post_id')->where('type' , 1)->orderBy('sort');
    }
    public function followers(){
        return $this->hasMany(FollowComment::class,'post_id');
    }

}
