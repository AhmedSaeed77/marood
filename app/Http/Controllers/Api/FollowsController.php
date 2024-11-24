<?php

namespace App\Http\Controllers\Api;

use App\Customs\FollowingServices\CategoryFollowing;
use App\Customs\FollowingServices\MemberFollowing;
use App\Customs\FollowingServices\PostsFollowing;
use App\Http\Controllers\Controller;
use App\Http\Resources\FollowedPostsResource;
use App\Http\Resources\UserResource;
use App\Models\FollowComment;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    use ApiTrait;


   public function toggleCat($id): JsonResponse
   {
       $followed = (new CategoryFollowing())->toggleCategory($id);
       return $this->sendMessageResponse($followed);
   }

   public function followedCategories(){
       $cats = (new CategoryFollowing())->categories();
       return $this->sendResponse('Categories Returned' , $cats);
   }

    public function followers(){
        $followers=auth()->user()->follower;
        $users=$followers->map(function ($follwer){
            return $follwer->user;
        });
        return $this->sendResponse('success' , UserResource::collection($users));
    }
    public function toggleMember($id): JsonResponse
    {
        $followed = (new MemberFollowing())->toggleMember($id);
        return $this->sendMessageResponse($followed);
    }

    public function members() {
        $members = (new MemberFollowing())->members();
        return $this->sendResponse('success' , $members);
    }



    public function togglePost($id): JsonResponse
    {
        $followed = (new PostsFollowing())->togglePost($id);
        return $this->sendMessageResponse($followed);
    }

    public function posts() {
        $posts = (new PostsFollowing())->posts();
        return $this->sendResponse('Posts Returned' , $posts);
    }


}
