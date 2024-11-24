<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayCommisionRequest;
use App\Http\Resources\CommisionMemberResource;
use App\Models\CommessionTransfer;
use App\Models\commissionMember;
use App\Models\Post;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CommisionController extends Controller
{
    use ApiTrait;
    public function index(){
        $commisions=commissionMember::all();
        return CommisionMemberResource::collection($commisions);
    }
    public function store(PayCommisionRequest $request) {
        $name = null;
        if ($request->hasFile('receipt_photo')){
            $file = $request->file('receipt_photo');
            $name = time() . md5(rand()) . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/transfer/' , $name);
            $avatar='transfer/'.$name;

        }

        if ($request->type == 1){
            try {
                $request->validate(['package_id' => ['required' , Rule::exists('member_ships' , 'id')]]);
                $request['post_number'] = null;
            }catch (\Exception $e){
                return $this->sendFailedMessage(__('site.Package Not Exists') ) ;}

        }else{
            if (Post::find($request['post_number'])) {

                if (!(Post::find($request['post_number'])->post_user->user->id == Auth::user()->id)) {
                    return $this->sendFailedMessage(__('site.Invalid Post') );
                }
                try {
                    $request->validate(['post_number' => ['required', Rule::exists('posts', 'id')]]);
                    $request['package_id'] = null;

                } catch (\Exception $e) {
                    return $this->sendFailedMessage(__('site.Post Not Exists'));
                }
            }
            //return $this->sendFailedMessage('not exist') ;
            //return $this->sendFailedMessage(__('site.Post Not Exists'));
        }

        $commission = CommessionTransfer::create([
            'username' => $request['username'],
            'user_id' => Auth::user()->id,
            'phone' => $request['phone'],
            'price' => $request['price'],
            'bank_id' => $request['bank_id'],
            'userBankName' => $request['money_sender'],
            'timeOfTransfer' => $request['date_of_transfer'],
            'post_number' => $request['post_number'],
            'package_id' => $request['package_id'],
            'notes' => $request['notes'],
            'receiptPhoto' =>  $avatar,
            'type' => $request['type']
        ]);
        Post::find($request['post_number'])->update([
            'is_pay' => 1
        ]);

        return $this->sendMessageResponse(__('site.Commission Payed Thank You !'));
    }
}
