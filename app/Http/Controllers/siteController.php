<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Post;
use App\Models\Area;
use App\Models\sessionCat;
use App\Models\footerPages;
use App\Models\setting;
use App\Models\HarajBank;
use App\Models\commissionMember;
use App\Models\MemberShip;
use App\Models\MembershipPackage;
use App\Models\transferDate;
use App\Models\CommessionTransfer;
use App\Models\user_rate;
use App\Models\ratesType;
use App\Models\Comment;
use App\Models\FollowComment;
use App\Models\FavPosts;
use App\Models\Conversation;
use App\Models\Msg_Conversation;
use App\Models\infraction;
use App\Models\postInfraction;
use App\Models\Follow_user;
use App\Models\followCat;
use App\Models\menues;
use App\Notifications\commentNotification;
use App\Models\WhyContact;
use App\Models\Contact;
use Carbon\Carbon;
use Validator;
use App\Notifications\contactNotfication;
use App\Notifications\InfractionNotfication;
use Auth;
use App\Models\Slidear;
use App\Traits\SendNotification;


class siteController extends Controller
{
   
     
  use SendNotification;

        
        public function search(Request $request)
        {
            
            $query = $request->input('query');
            $parent_id = $request->input('id');

            $area = Area::where('parent_id','=',$parent_id)->where('name_ar', 'LIKE', "%{$query}%")->orWhere('name_en', 'LIKE', "%{$query}%")->first();
          
          if(!$area){
              
              $areas = Area::where('parent_id','=',$parent_id)->get();

                return response()->json($areas);
          }
            // return $area;
            return response()->json($area);
        }

     
      public function checkRealStateType(Request $request)
    {
        $cat = Cat::query()->where('id','=',$request->id)->first();

        if($cat->type == 2 && $cat->parent_id == 5){

            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 520]);
        }
    }

    public function more_cats(){
        $menue=menues::find(5);
        return view('site.more_cats',compact('menue'));
    }

     public function logout(){
         return view('site.logout');
     }
     public function contact(){
         $reasons=WhyContact::get();
         return view('site.contact',compact('reasons'));
     }

    public function store_contact(Request $request){
        if($request->hasFile('files')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['files'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/contact/' , $file_name);
              $photo='contact/'.$file_name;
                }else{
                    $photo=Null;
                }
     $contact=Contact::create([
            'why_id'=>$request['contactUsReason'],
            'desc'=>$request['message'],
            'email'=>$request['email'],
            'photo'=>$photo,
//            'phone'=>$request['phone'],
            ]);
            $users=User::get();
            foreach($users as $user){

                      if($user->hasAnyRole('admin', 'superAdmin')){
            $user->notify(new contactNotfication($contact,'تم ارسال رساله اتصال جديده'));

                }
            }
                return redirect()->back()->with(['alert' => [
                    'icon' => 'success',
                    'title' =>' تم الارسال بنجاح ',
                    'text' =>  ''
                ]]);

    }
     public function footer_page($id,$link){
        $setting =setting::get();
        $page=footerPages::where('id',$id)->where('link',$link)->first();
        if($page){

        return view('site.page',compact('page','setting'));
        }else{
           return redirect()->back()->with(['alert' => [
                    'icon' => 'error',
                    'title' =>' هذة الصفحة غير متاحة ',
                    'text' =>  ''
                ]]);
        }
    }

    public function tenderDeal(){
           $page=footerPages::where('link','tender-deal')->first();
        return view('site.blacklist',compact('page'));
    }
    // -------------commission--------------------
    public function commission(){
        $setting=setting::get();
        $banks=HarajBank::get();
        $comissions=commissionMember::get();
        $memberships=MemberShip::get();
        $dates=transferDate::get();
        return view('site.memberShip.commession',compact('setting','banks','comissions','memberships','dates'));
    }
    public function member_ship($id){
        
          session(['url.intended' => url()->current()]);

          if(!auth()->check()){
              return redirect()->route('login');
          }
          
        session(['url.intended' => null]);

        // $member=MemberShip::find($id);
        $member=MemberShip::first();
        // $package=MembershipPackage::where('member_id',$id)->orderBy('created_at', 'desc')->get()->first();
        $package=MembershipPackage::orderBy('created_at', 'desc')->get()->first();

        return view('site.memberShip.member',compact('member','package'));
    }

    public function pay_commission(){
        return view('site.commession.pay');
    }

    public function packages($id){
        $member=MemberShip::find($id);
        $banks=HarajBank::get();
        $packages=MembershipPackage::where('member_id',$id)->orderBy('created_at', 'desc')->get();
        $dates=transferDate::get();
        return view('site.memberShip.packages',compact('member','packages','banks','dates'));
    }


     public function session($id){
        if(session()->has('sessionCat'))
        {
            $sessionCat = new sessionCat(session()->get('sessionCat'));
        }
        else
        {
            $sessionCat = new sessionCat();
        }
        $cat= Cat::find($id);
        $sessionCat->add($cat);
        session()->put('sessionCat' , $sessionCat);
        return back();
     }


     public function delSession(){
        session()->forget('sessionCat');
        return redirect()->back();
     }

    public function index(Request $request)
    {
        
      \Illuminate\Support\Facades\DB::table('posts')->update(['deleted_at' => NULL]);

        $setting =setting::get();
        $cats=Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get();
        $posts=Post::where('active',1)->orderBy('updated_at','desc')->paginate(25);
        if ($request->ajax()) {
           
        return view('site.postFilter',compact('posts','setting'));

        }
        $areas=Area::get();
        $slidear=Slidear::get();
        return view('site.index',compact('cats','posts','areas','setting','slidear'));
     }

    public function user_transfer(Request $request){
        
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'link'=>'required|numeric',
            'image'=>'required|image|mimes:jpg,jpeg,png,svg,gif',
            'moneysender'=>'required',
            'bank'=>'required',
            ],[
                'link.required'=>__('site.link require'),
                'link.numeric'=>__('site.link numeric'),
                'image.required'=>__('site.image required'),
                'image.image'=>__('site.image image'),
                'image.mimes'=>__('site.image mimes'),
                'bank.required'=>__('site.bank name required'),
                'moneysender.required'=>__('site.sender name required')
                ]);
                  if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
            $post_number = Post::where('id',$request['link'])->first();
            if(!is_null($post_number)){
            if($request->hasFile('file')){
                      $str=rand();
                          $result = md5($str);
                          $file =$request['file'];
                          $file_name = time() . $result . $file->getClientOriginalName();
                          $file->move(base_path() . '/public/storage/transfer/' , $file_name);
                    $avatar='transfer/'.$file_name;
                }

                if($request->hasFile('image')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['image'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/transfer/' , $file_name);
                    $avatar='transfer/'.$file_name;
              
              }

                $transfer=CommessionTransfer::create(
                    [
                        'bank_id'=>$request['bank'],
                        'user_id'=>auth::user()->id,
                        'price'=>$request['price'],
                        'username'=>$request['name'],
                        'phone'=>$request['mobile'],
                        'userBankName'=>$request['moneysender'],
                        'post_number'=>$request['link'],
                        'timeOfTransfer'=>$request['datetransfer'],
                        'type'=>$request['type'],
                        'notes'=>$request['message'],
                        'package_id'=>$request['package'],
                        'receiptPhoto' =>  $avatar,
                    ]
                );
                
                return redirect()->back()->with(['alert' => [
                    'icon' => 'success',
                    'title' =>' تم الارسال بنجاح ',
                    'text' => 'تم التحويل  بنجاح'
                ]]);
            }else{
                return redirect()->back()->with(['alert' => [
                    'icon' => 'error',
                    'title' =>'خطأ',
                    'text' => 'هذا الاعلان غير موجود يرجى ادخال رقم اعلان صحيح!'
                ]]);
            }
    }



  public function user_store_transfer(Request $request){
        
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'image'=>'required|image|mimes:jpg,jpeg,png,svg,gif',
            'moneysender'=>'required',
            'bank'=>'required',
            ],[
               
                'image.required'=>__('site.image required'),
                'image.image'=>__('site.image image'),
                'image.mimes'=>__('site.image mimes'),
                'bank.required'=>__('site.bank name required'),
                'moneysender.required'=>__('site.sender name required')
                ]);
                  if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
           
            if($request->hasFile('file')){
                      $str=rand();
                          $result = md5($str);
                          $file =$request['file'];
                          $file_name = time() . $result . $file->getClientOriginalName();
                          $file->move(base_path() . '/public/storage/transfer/' , $file_name);
                    $avatar='transfer/'.$file_name;
                }

                if($request->hasFile('image')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['image'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/transfer/' , $file_name);
                    $avatar='transfer/'.$file_name;
              
              }

                $transfer=CommessionTransfer::create(
                    [
                        'bank_id'=>$request['bank'],
                        'user_id'=>auth::user()->id,
                        'price'=>$request['price'],
                        'username'=>$request['name'],
                        'phone'=>$request['mobile'],
                        'userBankName'=>$request['moneysender'],
                        'post_number'=>$request['link'],
                        'timeOfTransfer'=>$request['datetransfer'],
                        'type'=>$request['type'],
                        'notes'=>$request['message'],
                        'package_id'=>$request['package'],
                        'receiptPhoto' =>  $avatar,
                    ]
                );
                
                return redirect()->back()->with(['alert' => [
                    'icon' => 'success',
                    'title' =>' تم الارسال بنجاح ',
                    'text' => 'تم التحويل  بنجاح'
                ]]);
            
    }


// --------------single post----------------
   public function single_post($id){
       
       $post=Post::find($id);
       $infractions=infraction::get();
       $parent=Cat::find($post->cat_id);
       $CountFav=count(FavPosts::where('post_id',$id)->get());
       if($parent->parent_id != null){
        while(!empty($parent->parent)){
           $parent=$parent->parent;
           }

       }
       $rating=user_rate::where('user_id',$post->post_user->user_id)->where('user_id',1)->get();
       $rate=ratesType::find(1);
       $nextPost=Post::where([
           'cat_id'=>$post->cat_id,
           'area_id'=>$post->area_id,
       ])->where('id','>',$post->id)->first();
       $similarPost=Post::where('cat_id',$post->cat_id)->get();
       $smP=Post::where('cat_id',$post->cat_id)->get()->pluck('id')->toArray();
       $similarPostArea=Post::where('cat_id',$post->cat_id)->where('area_id',$post->area_id)->whereNotIn('id',$smP)->get();
       
        $options = [
           'equipped_kitchen' => __('site.equipped_kitchen'),
           'feminine' => __('site.feminine'),
           'driver_room' => __('site.driver_room'),
           'maid_room' => __('site.maid_room'),
           'there_is_a_fireplace' => __('site.there_is_a_fireplace'),
           'appendix' => __('site.appendix'),
           'car_entrance' => __('site.car_entrance'),
           'elevator' => __('site.elevator'),
           'vault' => __('site.vault'),
           'air_conditioning' => __('site.air_conditioning'),
           'swimming_pool' => __('site.swimming_pool'),
           'drawer' => __('site.drawer'),
           'monsters' => __('site.monsters'),
       ];

       $villa_types = [
           'independent' => __('site.independent'),
           'duplex' => __('site.duplex'),
           'townhouse' => __('site.townhouse'),
           'with_apartments' => __('site.with_apartments'),
       ];

       $destinations = [
           'north' => __('site.north'),
           'south' => __('site.south'),
           'east' => __('site.east'),
           'west' => __('site.west'),
           'southeast' => __('site.southeast'),
           'southwest' => __('site.southwest'),
          'northeast' => __('site.northeast'),
           'northwest' => __('site.northwest'),
           'three_streets' => __('site.three_streets'),
           'four_streets' => __('site.four_streets'),

       ];

       $street = [
           'residential' => __('site.residential'),
           'commercial' => __('site.commercial'),
       ];
       if(auth::check()){
       $follow_commnet=FollowComment::where([
        'post_id'=>$id,
        'user_id'=>auth::user()->id,
    ])->first();
    return view('site.post.single',compact('options','villa_types','destinations','street','post','rating','rate','nextPost','parent','similarPost','similarPostArea','CountFav','follow_commnet','infractions'));
       }

       return view('site.post.single',compact('options','villa_types','destinations','street','post','rating','rate','nextPost','parent','similarPost','similarPostArea','CountFav','infractions'));
   }
   
   public function delete_comment($id)
   {
       $comment = Comment::query()->findOrFail($id);
       $comment->delete();

       return redirect()->back();
   }
   
   public function post_infraction(Request $request ,$id){
   $inf= postInfraction::create([
        'post_id'=>$id,
        'notes'=>$request['notes'],
        'type_id'=>$request['infraction'],
        'user_id'=>auth::user()->id
    ]);
    $post=Post::find($id);
      $users=User::get();
    foreach($users as $user){
       if($user->hasAnyRole('admin', 'superAdmin')){
            $user->notify(new InfractionNotfication($inf,' لقد قام'.auth::user()->name.' '.'بالأبلاغ عن الاعلان'.$post->title_ar));
       }
    }
    return redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>' تم  بنجاح ',
        'text' => 'تم ارسال الأبلاغ  بنجاح'
    ]]);

   }
   public function comment_infraction(Request $request ){
    postInfraction::create([
        'post_id'=>$request['post_id'],
        'comment_id'=>$request['comment_id'],
        'type_id'=>$request['type_id'],
        'user_id'=>auth::user()->id
    ]);
          $users=User::get();
    foreach($users as $user){
       if($user->hasAnyRole('admin', 'superAdmin')){
            $user->notify(new InfractionNotfication($inf,' لقد قام'.auth::user()->name.' '.'بالأبلاغ عن تعليق يندرج تحت الاعلان'.$post->title_ar));
       }
    }
    return redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>' تم  بنجاح ',
        'text' => 'تم ارسال الأبلاغ  بنجاح'
    ]]);

   }

public function change_comment_show(Request $request){
    $post=Post::find($request['id']);
    if($post->comment==1){
        $post->update(["comment"=>0]);
       }else{
        $post->update(["comment"=>1]);
       }
    $post->save;
    return $post->comment;
}
public function show_on_map(Request $request){
    $post=Post::find($request['id']);
     if($post->Show_on_map==1){
      $post->update(["Show_on_map"=>0]);
     }else{
      $post->update(["Show_on_map"=>1]);
     }
    return $post->Show_on_map;
}
   public function comment_post($id,Request $request){

        $validate = Validator::make($request->all() , [
            'comment'=>'required'
          ]);

        if($validate->fails()){
            return redirect()->back()->with(['alert' => [
                'icon' => 'error',
                'title' =>'خطأ',
                'text' => 'لا يمكن ارسال تعليق فارغ!'
            ]]);
        }

        $comment=Comment::create([
          'post_id'=>$id,
          'user_id'=>auth::user()->id,
          'comment'=>$request['comment'],
          'parent_id'=>$request['parent_id'],
        ]);

       $this->sendCommentNotification($id,$comment);
       return redirect()->back();
   }
   public function update_post_date(Request $request){

        $post=Post::find($request['id']);
        $now = Carbon::now();

        $diffInHours = Carbon::parse($post->created_at);
        $diffInHours_updated = Carbon::parse($post->updated_at);

        $length = $diffInHours->diffInHours($now);
        $length_updated = $diffInHours_updated->diffInHours($now);
        if ($length > 72&& $length_updated > 72) {
           $post->touch();
           return '0';
        }else{
            return '1';
        }
   }
   public function edit_single_post($id){
        $post=Post::find($id);

        // $now = Carbon::now();

        // $diffInHours = Carbon::parse($post->created_at);

        // $length = $diffInHours->diffInHours($now);

        // if ($length > 48) {
           $cats=Cat::where('parent_id',NULL)->get();
           
           
             ######## Real State additional_options
       $list = [];

       if($post->Cat->type == 2 && $post->additional_options != null && is_array($decodedOptions = json_decode($post->additional_options, true)))
       {
           foreach ($decodedOptions as $item){
               $list[] = $item;
           }
       }

           return view('site.post.edit_single',compact('post','cats','list'));
        // }else{
        //     return redirect()->back()->with(['alert' => [
        //                 'icon' => 'error',
        //                 'title' =>__('site.warning'),
        //                 'text' => __('site.before 28 hours')
        //                 ]]);
        // }


   }
   public function update_area_post(Request $request){
       $post=Post::find($request['post_id']);
       $post->update(['area_id'=>$request['area_id']]);
       return 'success';
    }

   public function follow_comment($id){
    $follow=FollowComment::where([
        'post_id'=>$id,
        'user_id'=>auth::user()->id,
    ])->first();
    if($follow){
        $follow->delete();
    }else{
        $follow=FollowComment::create([
            'post_id'=>$id,
            'user_id'=>auth::user()->id,
        ]);
    }
    return redirect()->back();
   }

   public function sendCommentNotification($post_id,$comment){
         $follower=FollowComment::where('post_id',$post_id)->get();
         $followCommentTitle="يوجد تعليق جديد على اعلان قمت بمتابعة ردودة";
         $post=Post::find($post_id);
         foreach($follower as $f){
             $user=$f->user;
            $user->notify(new commentNotification($post,$comment,$followCommentTitle));
         }
   }

   public function fav_post($id){
       $fav= FavPosts::where([
        'post_id'=>$id,
        'user_id'=>auth::user()->id,
    ])->first();
    if(empty($fav)){
        FavPosts::create([
            'post_id'=>$id,
            'user_id'=>auth::user()->id,
        ]);
    }else{
        $fav->delete();
    }
    return redirect()->back();
   }
public function fav_posts(){
    $posts=auth::user()->fav_posts;
    return view('site.post.favpost',compact('posts'));
}
// ========================================================
//  ============user========================================
// ============================================================
public function user_profile($id){
    $user=User::find($id);
    $f=0;
    if(Auth::check())
    {
        if(auth::user()->id!=$id)
        {
        $follow= Follow_user::where(['user_id'=>auth::user()->id,'follow_user_id'=>$id])->first();
        if($follow != null){
            $f=1;
        }
        }
    }
    $is_pay=1;
    foreach($user->user_posts as $post){
        if($post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
    }
return view('site.user.profile',compact('user','f','is_pay'));
}
// -----------rate------------
public function user_rate($id){
$user=User::find($id);
$is_pay=1;
  foreach($user->user_posts as $post){
        if($post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
    }
    $f=0;
    if(Auth::check())
    {
        if(auth::user()->id!=$id)
        {
        $follow= Follow_user::where(['user_id'=>auth::user()->id,'follow_user_id'=>$id])->first();
        if($follow != null){
            $f=1;
        }
        }
    }
return view('site.user.rating',compact('user','is_pay','f'));
}

public function add_rate($id){
$user=User::find($id);
$is_pay=1;
  foreach($user->user_posts as $post){
        if($post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
    }
    $f=0;
    if(Auth::check())
    {
        if(auth::user()->id!=$id)
        {
        $follow= Follow_user::where(['user_id'=>auth::user()->id,'follow_user_id'=>$id])->first();
        if($follow != null){
            $f=1;
        }
        }
    }
return view('site.user.add_rate',compact('user','is_pay','f'));
}

public function store_rate($id,Request $request){

        $request->validate([
        'notes'=>'required|max:255',
        'image'=>'nullable|image|mimes:jpg,jpeg,png,svg,gif',
         'advanced'=>'required',
         'answer'=>'required',
        ],[
        'notes.required'=>'وصف التجربة مطلوب',
        'notes.max'=>'لا يمكن  ان يزيد الوصف عن 255 حرف',
         'advanced.required'=>__('site.recommend required'),
        'image.image'=>__('site.image image'),
        'image.mimes'=>__('site.image mimes'),
        'answer.required'=>__('site.answer required'),
            ]);

    if($request['advanced']=='yes'){
        $advance=1;
    }else{
        $advance=0;
    }
    if($request['answer']=='yes'){
        $answer=1;
    }else{
        $answer=0;
    }
    $f=0;
    if(Auth::check())
    {
        if(auth::user()->id!=$id)
        {
        $follow= Follow_user::where(['user_id'=>auth::user()->id,'follow_user_id'=>$id])->first();
        if($follow != null){
            $f=1;
        }
        }
    }


    if($request->hasFile('image')){
          $str=rand();
              $result = md5($str);
              $file =$request['image'];
              $file_name = time() . $result . $file->getClientOriginalName();
              $file->move(base_path() . '/public/storage/rates/' , $file_name);
        $rating_img='rates/'.$file_name;
    }

    $rate= new user_rate;
    $rate->user_id=auth::user()->id;
    $rate->rate_for_userid=$id;
    $rate->recommend=$advance;
    $rate->rate_type=$answer;
    $rate->notes=$request['notes']??null;
    $rate->image=$rating_img??null;
    $rate->save();
    $user=User::find($id);
   $is_pay=1;
  foreach($user->user_posts as $post){
        if($post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
    }
return view('site.user.rating',compact('user','f','is_pay'));
}

// =========conversation=============

public function send_msg(Request $request){
//   $conv= Conversation::Where('user_id',auth::user()->id)->where('follow_user_id',$request['to'])->first();

//   if($conv==null){
//       $conv=Conversation::Where('follow_user_id',auth::user()->id)->where('user_id',$request['to'])->first();
//   }

//       if($conv==null){
//             $conv= Conversation::create(['user_id'=>auth::user()->id,'follow_user_id'=>$request['to']]);;
//       }
//       Msg_Conversation::create([
//           'conv_id'=>$conv->id,
//           'sender'=>auth::user()->id,
//           'reciever'=>$request['to'],
//           'msg_content'=>$request['msg'],
//       ]);


 $conv= Conversation::Where('user_id',auth::user()->id)->where('follow_user_id',$request['to'])->first();

   if($conv==null){
       $conv=Conversation::Where('follow_user_id',auth::user()->id)->where('user_id',$request['to'])->first();
   }

      if($conv==null){
            $conv= Conversation::create(['user_id'=>auth::user()->id,'follow_user_id'=>$request['to']]);;
      }
    $newMessage = Msg_Conversation::create([
           'conv_id'=>$conv->id,
           'sender'=>auth::user()->id,
           'reciever'=>$request['to'],
           'msg_content'=>$request['msg'],
       ]);


    $fcmToken1 = User::find($conv->follow_user_id)->firebaseToken;
    $fcmToken2 = User::find($conv->user_id)->firebaseToken;

    $username = User::find($newMessage->reciever)->name;
    $this->sendFirebaseNotificationChat([$fcmToken1,$fcmToken2],$conv->id,$newMessage->msg_content ?? 'file', $newMessage->reciever,$username);

       return redirect()->back()->with(['alert' => [
       'icon' => 'success',
       'title' =>' تم  بنجاح ',
       'text' => 'تم ارسال الرسالة  بنجاح'
       ]]);
}


public function followCat(Request $request){
    $follow=followCat::where(['cat_id'=>$request['cat_id'],'user_id'=>auth::user()->id])->first();
    if($follow ==null){
    followCat::create(['cat_id'=>$request['cat_id'],'user_id'=>auth::user()->id]);
    }else{
        $follow->delete();
    }
    return 'success';
}
            // ===================================================
            // -------------------------chat----------------------
            // ======================================================
public function chat(){

    $users=User::where('id','!=',auth::user()->id)->get();
    // $conver=Conversation::where('user_id',auth::user()->id)->orWhere('follow_user_id',auth::user()->id)->get();
    return view('site.user.chat',compact('users'));
}
public function chat_conv($id){

 $conv=Conversation::find($id);
 $msgs=$conv->msgs;
 foreach($msgs->where('reciever',auth::user()->id) as $msg){
     $msg->update(['read'=>1]);
 }
 return view('site.user.chatConv',compact('conv','msgs'));
}
public function send_msg_chat(Request $request){

    Msg_Conversation::create([
        'conv_id'=>$request->conv_id,
        'sender'=>auth::user()->id,
        'reciever'=>$request['conv_reciver'],
        'msg_content'=>$request['msg'],
    ]);
    return [$request->conv_id,$request['conv_reciver']];
}
public function new_conv($user_id){

  $conv= Conversation::Where('user_id',auth::user()->id)->where('follow_user_id',$user_id)->first();

   if($conv==null){
       $conv=Conversation::Where('follow_user_id',auth::user()->id)->where('user_id',$user_id)->first();
   }

      if($conv==null){
            $conv= Conversation::create(['user_id'=>auth::user()->id,'follow_user_id'=>$user_id]);;
      }
   $msgs=$conv->msgs;
   if($msgs){
   foreach($msgs->where('reciever',auth::user()->id) as $msg){
       $msg->update(['read'=>1]);
   }
   }
   return redirect()->route('chat_conv',$conv->id);
}

public function chat_conv_delete($id){
  $msgs= Msg_Conversation::where('conv_id',$id)->get();
  foreach($msgs as $msg){
      $msg->delete();
  }
  return redirect()->back();
}

public function search_user(Request $request){
    $users=User::where('name','like', '%' . $request['text'] . '%')->get();
  return  response()->json($users);
}


public function getTags(Request $request)
{
    $category = cat::query()->where('id','=', $request->cat_id)->first();

    if($category->parent_id == 5){
        $area = Area::query()->with(['children'])->where('id', $request->area_id)->first();

        $count = Post::query()->where('cat_id',$request->cat_id)->where('area_id','=',$request->area_id)->count();

        // Add post counts for each child area
        foreach ($area->children as $child) {
            $child->post_count = Post::query()
                ->where('cat_id', $request->cat_id)
                ->where('area_id', $child->id)
                ->count();
        }

        return response()->json(['category' => $category, 'area' => $area, 'count' => $count,]);
    }

}



}
