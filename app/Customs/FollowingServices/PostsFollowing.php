<?php

namespace App\Customs\FollowingServices;

use App\Http\Resources\FollowedPostsResource;
use App\Models\Follow_user;
use App\Models\FollowComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostsFollowing
{
    public function togglePost($id)
    {
        $exists = FollowComment::where([
            'user_id' => Auth::user()->id,
            'post_id' => $id
        ])->exists();
        if (!$exists){
            FollowComment::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id
            ]);
            return __("site.Post Followed");
        }else{
            FollowComment::where('user_id',Auth::user()->id)->where('post_id',$id)->delete();
            return __('site.Post UnFollowed');
        }

    }

    public function posts() {
        $posts = Auth::user()->userFollowPost;
        return  FollowedPostsResource::collection($posts);
    }


}
