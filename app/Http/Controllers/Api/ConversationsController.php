<?php

namespace App\Http\Controllers\Api;

use App\Events\PushChatMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MsgResource;
use App\Models\Conversation;
use App\Models\Msg_Conversation;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Traits\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    use ApiTrait,SendNotification;

    public function index() {

        // $conversations = Conversation::where('user_id' , Auth::user()->id)->orWhere('follow_user_id' , Auth::user()->id)->get();
        // return $this->sendResponse('success' , ConversationResource::collection($conversations));


        $conversations =  Conversation::query()
            ->with(['msgs' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where(function($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('follow_user_id', Auth::user()->id);
            })
            ->orderBy(
                Msg_Conversation::select('created_at')
                    ->whereColumn('conv_id', 'conversations.id')
                    ->orderBy('created_at', 'desc')
                    ->limit(1),
                'desc'
            )
            ->get();

         return $this->sendResponse('success' , ConversationResource::collection($conversations));

    }

    public function show($id) {

        $conversation = Conversation::find($id);
        $messages = Conversation::find($id)->msgs;

        if (count($messages) > 0){
            foreach($messages->where('reciever',auth('api')->id()) as $msg){
                $msg->update(['read'=>1]);
            }
        }

        $data['chat_id'] = $conversation->id;
        $data['reciever'] = $conversation->user_id == auth('api')->id() ?  User::query()->find($conversation->follow_user_id)->name :  User::query()->find($conversation->user_id)->name;
        $data['messages'] = MsgResource::collection($messages);

        return $this->sendResponse('success' ,$data );
    }

    public function sendMsg(Request $request,$id) {

        $conversation = Conversation::find($id);

        if(is_null($request->file_type)){

            return  response()->json(['message' => 'Validation failed', 'errors' => "يجب ارسال نوع الرساله مثال (ملف-نص)"], 422);
        }

        if($request->message == null && $request->file == null){

            return  response()->json(['message' => 'Validation failed', 'errors' => "يجب ارسال رساله او صوره او ملف صوتي"], 422);
        }

        if(!in_array($request->file_type,['text','file','record'])){
            return  response()->json(['message' => 'Validation failed', 'errors' => "نوع الرساله يجب ان تكون ملف مرفق او رساله"], 422);
        }

        $data = [
            'sender' => auth('api')->id(),
            'reciever' => $conversation->user_id == auth('api')->id() ? $conversation->follow_user_id : $conversation->user_id ,
            'msg_content' => request()->hasfile('file') == null ? request('message') : null,
            'conv_id' => $id,
            'file_type' => $request->file_type,
        ];

        if ($request->hasfile('file')) {
            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move('chat/', $name);
            $imagePath = 'chat/'.$name;
            $data['file'] = $imagePath;

            $data['file_type'] = $request->file_type;
        }

        $newMessage = Msg_Conversation::create($data);

        $fcmToken1 = User::find($conversation->follow_user_id)->firebaseToken;
        $fcmToken2 = User::find($conversation->user_id)->firebaseToken;

        $username = User::find($newMessage->reciever)->name;

         $this->sendFirebaseNotificationChat([$fcmToken1,$fcmToken2],$conversation->id,$newMessage->msg_content ?? 'file', $newMessage->reciever,$username);

//        broadcast(new PushChatMessageEvent($newMessage))->toOthers();

        return $this->sendMessageResponse(__('message sent'));
    }

    public function newChat($id){

        $exists = Conversation::where([
            'user_id' => Auth::user()->id,
            'follow_user_id' => $id
        ])->orWhere(function ($query) use ($id) {
            $query->where('follow_user_id' ,  Auth::user()->id)
                ->where('user_id' , $id);
        })->exists();


        if ($exists)
            return $this->sendFailedMessage(__('site.Chat Already Exists'));

        Conversation::create([
            'user_id' => Auth::user()->id,
            'follow_user_id' => $id
        ]);
        return $this->sendMessageResponse(__('site.Chat Created') ) ;


    }


    public function chatDetailsByUserId($id) {


        $chat = Conversation::where([
            'user_id' => Auth::user()->id,
            'follow_user_id' => $id
        ])->orWhere(function ($query) use ($id) {
            $query->where('follow_user_id' ,  Auth::user()->id)
                ->where('user_id' , $id);
        })->first();

        if(!$chat){
            $newChat = Conversation::create([
                'user_id' => Auth::user()->id,
                'follow_user_id' => $id
            ]);
        }

        $chatId =  $chat ? $chat->id : $newChat->id;

        $lastChat = Conversation::query()->find($chatId);

        $messages = Conversation::find($chatId)->msgs;
        if (count($messages) > 0)
            $messages->last()->update(['read' => 0]);


        $data['chat_id'] = $lastChat->id;
        $data['reciever'] = $lastChat->user_id == auth('api')->id() ?  User::query()->find($lastChat->follow_user_id)->name :   User::query()->find($lastChat->user_id)->name;
        $data['messages'] = MsgResource::collection($messages);

        return $this->sendResponse('success' ,$data);
    }


    public function destroy($id) {
        $chat = Conversation::find($id);
        if ($chat){
            if (Auth::user()->id == $chat->user_id || Auth::user()->id == $chat->follow_user_id){
                $chat->delete();
                return $this->sendMessageResponse(__('site.Chat Deleted') );
            }

            return $this->sendMessageResponse(__('site.error'));
        }
    return $this->sendFailedMessage(__('site.Chat Not Found') );
    }
}
