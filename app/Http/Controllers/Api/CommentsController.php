<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\FollowComment;
use App\Models\Post;
use App\Models\User_posts;
use App\Models\User;
use App\Models\user_rate;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\SendNotification;


class CommentsController extends Controller
{
    use ApiTrait;
    use SendNotification;


    public function index($id) {
//        $posts=DB::statement('SELECT  FROM `posts` WHERE 1') ;
//        return Post::all();
//        return  1;
//        return Post::find(605)->followers->user;
//        $follows= FollowComment::where('post_id',605)->get();
//        return FollowComment::where('post_id',605)->with('user')->get();
//        return $users=$follows->with('user');
        $comments = Post::find($id)->parentComments;
        return $this->sendResponse('success' , CommentResource::collection($comments));
    }

    public function store(Request $request , $id) {

       
        $request->validate(['comment' => 'required']);
       $comment = Comment::create([
            'post_id' => $id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        $post_user = User_posts::query()->where('post_id','=', $id)->first();
        $user = User::find($post_user->user_id);

        // $this->sendCommentNotification($id,$comment);

        if($comment->user_id != $user->id){
            $userIds = FollowComment::query()->where('post_id',$id)->where('user_id','!=',$comment->user_id)->pluck('user_id')->toArray();

            foreach ($userIds as $userId) {

                $client = User::query()->find($userId);

                $this->commentAddPost($client->firebaseToken,$id,$comment->comment,$user->id);
            }
        }

        return $this->sendMessageResponse(__('site.Commented'));
    }

    private function preparePush($id) {
        $follwers=FollowComment::where('post_id',$id)->where('user_id','!=',JWTAuth::user()->id)->with('user')->get();
        $firebaseTokens=$follwers->map(function ($follow){
            return $follow['user']['firebaseToken'];
        });
        $user_id=Post::find($id)->post_user->user_id;
        $notification =[
            'registration_ids' => $firebaseTokens,
            'notification' => [
                'title' => __('site.comment_added'),
                'body' => __('site.comment_added_body'),
            ],
            'data' => [
                'post_id' =>$id,
                'user_id' =>$user_id,
            ],
        ];
        return json_encode($notification);
    }
    private function sendNotification($id){
        try {
            $notification = $this->preparePush($id);
            $headers = [
                'Authorization: key=' .env('FIREBAS_SERVER_KEY'),
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $notification);
            curl_exec($ch);
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function reply($id , Request $request) {
        $request->validate(['comment' => 'required']);
        $comment = Comment::find($id);
        Comment::create([
            'post_id' => $comment->post->id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'parent_id' => $id
        ]);
        return $this->sendMessageResponse(__('site.Reply Sent') );
    }

    public function delete($id) {
        Comment::find($id)->delete();
        return $this->sendMessageResponse(__('Comment Deleted') );
    }


}
