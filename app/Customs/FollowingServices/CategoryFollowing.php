<?php

namespace App\Customs\FollowingServices;

use App\Http\Resources\FollowedCategoriesResource;
use App\Models\followCat;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Auth;

class CategoryFollowing
{


    public function categories() {
        $cats = Auth::user()->userFollowCat;
        return  FollowedCategoriesResource::collection($cats);
    }

    public function toggleCategory($id){
        $exists = followCat::where([
            'user_id' => Auth::user()->id,
            'cat_id' => $id
        ])->exists();
        if (!$exists){
            followCat::create([
                'user_id' => Auth::user()->id,
                'cat_id' => $id
            ]);
            return __("site.Category Followed");
        } else{
            followCat::where([
                'user_id' => Auth::user()->id,
                'cat_id' => $id
            ])->delete();
        }
        return __("site.Category unFollowed");
    }



}
