<?php

namespace App\Customs\FollowingServices\Categories;

use App\Http\Resources\FollowedCategoriesResource;
use App\Models\followCat;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Auth;

class CategoryFollowing
{

    public function followCategory($id){
        $exists = followCat::where([
            'user_id' => Auth::user()->id,
            'cat_id' => $id
        ])->exists();
        if (!$exists){
            followCat::create([
                'user_id' => Auth::user()->id,
                'cat_id' => $id
            ]);
            return "Category Followed";
        }
        return "Already Followed";

    }
    public function categories() {
        $cats = Auth::user()->userFollowCat;
        return  FollowedCategoriesResource::collection($cats);
    }

    public function categoriesUnFollow($id) {
        followCat::find($id)->delete();
        return 'Category Un Followed';
    }

}
