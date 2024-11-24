<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfractionResource;
use App\Models\Comment;
use App\Models\infraction;
use App\Models\Post;
use App\Models\postInfraction;
use App\Models\User;
use App\Notifications\InfractionNotfication;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfractionsController extends Controller
{
    use ApiTrait;
    public function index() {
        $infractions = infraction::get(['id' , 'title_en' , 'title_ar']);
        return $this->sendResponse('success' , InfractionResource::collection($infractions));
    }

    public function reportPost($id , Request $request){
        $post = Post::select('id' , 'title_ar')->find($id);
        $report = postInfraction::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post['id'],
            'type_id' => $request['infraction'],
            'notes' => $request['notes']
        ]);
        $users = User::get('id');
        foreach ($users as $user){
            if ($user->hasAnyRole('admin' , 'superAdmin')){
                $user->notify(new InfractionNotfication($report,' لقد قام'.Auth::user()->name.' '.'بالأبلاغ عن الاعلان'.$post['title_ar']));
            }
        }

        return $this->sendMessageResponse(__('site.post reported'));

    }

    public function reportComment($id , Request $request){
        $comment = Comment::select('id' , 'post_id')->find($id);
        $report = postInfraction::create([
            'user_id' => Auth::user()->id,
            'post_id' => $comment['post_id'],
            'comment_id' => $id,
            'type_id' => $request['infraction'],
            'notes' => $request['notes']
        ]);
        $post = Post::select('id' , 'title_ar')->find($comment['post_id']);
        $users = User::get('id');
        foreach ($users as $user){
            if ($user->hasAnyRole('admin' , 'superAdmin')){
                $user->notify(new InfractionNotfication($report,' لقد قام'.Auth::user()->name.' '.'بالأبلاغ عن الاعلان'.$post['title_ar']));
            }
        }
        return $this->sendMessageResponse(__('site.reported'));
    }
}
