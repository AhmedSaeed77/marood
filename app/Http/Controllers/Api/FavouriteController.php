<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavResource;
use App\Http\Resources\PostResource;
use App\Models\FavPosts;
use App\Models\Post;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    use ApiTrait;
    public function index() {
        $myFavs = Auth::user()->fav_posts;
        return $this->sendResponse('success' , FavResource::collection($myFavs));
    }

    public function store($id) {
//        $fav = FavPosts::where(['user_id' => Auth::user()->id, 'post_id' => $id])->exists();
//        if (!$fav){
//            FavPosts::create([
//                'user_id' => Auth::user()->id,
//                'post_id' => $id
//            ]);
//            return $this->sendMessageResponse('Added To Favourites');
//        }
//
//        return $this->sendMessageResponse('Already Added');

        $post = Post::find($id);
        if (! $post->checkFav() ) {
            FavPosts::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id
            ]);
        }else{
            FavPosts::where([
                'user_id' => Auth::user()->id,
                'post_id' => $id
            ])->delete();
        }

        return $this->sendMessageResponse(__('site.Fav Toggled'));
    }

    public function destroy($id) {
        FavPosts::find($id)->delete();
        return $this->sendMessageResponse(__('site.Removed From Favourites'));
    }
}
