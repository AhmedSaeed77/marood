<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\role;
use App\Models\Follow_user;
use App\Models\followCat;
use App\Models\UserContact;
use App\Models\FollowComment;
use App\Models\Verify_store;
use Auth;
use App\Models\UserPhone;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function admin_noti(){
         return view('admin.noti');
     }
     
     
    public function index()
    {
        //
        $users=User::where('member_id','=',null)->get();
        return view('admin.users.index',compact('users'));
    }
    
    
      
    public function members()
    {
       $users=User::where('member_id','!=',null)->get();
        return view('admin.users.members',compact('users'));
    }
   public function users_show_not($id){
              $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
        $users=User::get();
        return view('admin.users.index',compact('users'));
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=role::get();
        return view('admin.users.create',compact('roles'));
    }
    
    
     public function createMember()
    {
        
        $roles=role::get();
        return view('admin.users.create_member',compact('roles'));
    }
    
    public function active($id){
        $user=User::find($id);
        if($user->active==0){
            $user->active=1;
        }
        else{
            $user->active=0;
        }
        $user->save();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم التفعيل',
            'text' => 'تم تفعيل المستخدم بنجاح'
        ]]);
    }
    public function black_user($id){
             $user=User::find($id);
        if($user->active==2){
            $user->active=1;
        }
        else{
            $user->active=2;
        }
        $user->save();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم ',
            'text' =>'تم بنجاح'
        ]]);   
    }
        
    public function search_user_blackList(Request $request){
        $user=User::where('name',$request['user'])->orWhere('phone',$request['user'])->first();
        if($user){
        if($user->active==2){
            $black=__('site.The account or mobile number is in the blacklist');
        }else{
            $black=__('site.The account or mobile number is not in the blacklist');
        }
        }else{
            $black=__('site.user not found');
        }
        return $black;
    }
        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_index(){
        $stores=Verify_store::get();
        return view('admin.users.stores',compact('stores'));
    }
    
    public function accept_verify($id){
        $store=Verify_store::find($id);
        if($store->verify==1){
            $store->verify=0;
        }else{
            $store->verify=1;
        }
        $store->save();
          return redirect()->back()->with(['alert' => [
                'icon' => 'success',
                'title' =>'تم بنجاح',
                'text' => ' '
            ]]);
        
    }
  public function store(Request $request)
    {
        //
      $rules= [
          'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone-code' => ['required'],
            'phone' => ['required', 'numeric', 'unique:users', 'digits_between:6,11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar'=> ['mimes:jpeg,jpg,png,gif'],
            
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
             return redirect()->back()->withErrors($validate)
                        ->withInput();
          }
        if($request->hasFile('avatar')){
            $str=rand();
            $result = md5($str);
            $file =$request['avatar'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/users/' , $file_name);
      $photo='users/'.$file_name;
        }else{
            $photo='users/default.png';
        }
           User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone-code'].$request['phone'],
                'password' => Hash::make($request['password']),
              
                'avatar'=>$photo,
                
            ]);
            return redirect()->route('users.index')->with(['alert' => [
                'icon' => 'success',
                'title' =>'تمت  الاضافه',
                'text' => 'تم اضافه المستخدم بنجاح'
            ]]);
    }



public function storeMember(Request $request)
    {
        //
      $rules= [
          'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone-code' => ['required'],
            'phone' => ['required', 'numeric', 'unique:users', 'digits_between:6,11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar'=> ['mimes:jpeg,jpg,png,gif'],
            
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
             return redirect()->back()->withErrors($validate)
                        ->withInput();
          }
        if($request->hasFile('avatar')){
            $str=rand();
            $result = md5($str);
            $file =$request['avatar'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/users/' , $file_name);
      $photo='users/'.$file_name;
        }else{
            $photo='users/default.png';
        }
           User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone-code'].$request['phone'],
                'password' => Hash::make($request['password']),
                'member_id' => 1,
                'avatar'=>$photo,
                
            ]);
            return redirect()->route('members')->with(['alert' => [
                'icon' => 'success',
                'title' =>'تمت  الاضافه',
                'text' => 'تم اضافه المشترك بنجاح'
            ]]);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $user=User::find($id);
        foreach($user->user_posts as $post){
            $post->post->delete();
        }
        $user->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف المستخدم بنجاح'
        ]]);;
    }



    // =================================================================================

    // ----------------follow user----------------------
            public function follow_user(Request $request){
                $follow=Follow_user::where([
                    'user_id'=>auth::user()->id,
                    'follow_user_id'=>$request->user_id,
                ])->first();
                if($follow==Null){
                    $follow=Follow_user::create([
                        'user_id'=>auth::user()->id,
                        'follow_user_id'=>$request->user_id,
                    ]);
                }else{
                    $follow->delete();
                }
                return $follow;
            }
     // ------------edit store------------------------    
            public function edit_store($id){
                $user=User::find($id);
                if($user->store_identify==null){
                   return view('site.user.add_identifier',compact('user'));
                }else{
                   return view('site.user.edit_store',compact('user'));
                }
            }
    // ------------notification------------------------
    public function edit_identifier(){
        return view('site.user.add_identifier');
    }
    public function user_notify(){
        return view('site.user.notifications');
    }


    public function notification_show($id){
        $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
  
        return redirect()->route('single_post',$noty->data['post_id']);
    } 
    
    
    public function notification_show_user($id){
        $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
        $post=Post::find($noty->data['post_id']);
        return redirect()->route('user_profile',$post->post_user->user_id);
    }

    public function del_notification(){
        foreach(Auth::user()->notifications as $not){
                $not->delete();
        } 
    }

    // -----------follow-up------------
    public function follow_up(){
        return view('site.user.follow_up');
    }
    public function cancel_follow_user(Request $request){
        Follow_user::find($request['id'])->delete();
        return 'success';
    }
    public function cancel_follow_cat(Request $request){
        followCat::find($request['id'])->delete();
        return 'success';
    }
    public function cancel_post_follow(Request $request){
        FollowComment::find($request['id'])->delete();
        return 'success';
    }
    // -----------verify store---------
    public function verify_store($id)
    {   $user=User::find($id);
          return view('site.user.verify',compact('user'));
    }

    public function verify_with_abshar($id){
        $user=User::find($id);
        if(auth::user()->store_identify==null and auth::user()->id!=1){
            return view('site.user.add_identifier');
        }else{
            return view('site.user.abshar_verify',compact('user'));
        }
    }
    
    public function verify_with_documentation(){
        
        if(auth::user()->store_identify==null and auth::user()->id!=1){
            return view('site.user.add_identifier');
        }else{
            return view('site.user.verify_doc');
        }
    }
    public function verify_with_documentation2(){
        return view('site.user.verify_doc2');
    }
    public function store_verify(Request $request){
       
        if($request['type']){
            if($request['type']==1){
                $verify=Verify_store::create([
                'user_id'=>auth::user()->id,
                'ID_number'=>$request['Id'],
                'type'=>$request['type']
                ]);
                return redirect()->route('user_profile',auth::user()->id)->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم بنجاح',
                    'text' => 'سيتم التواصل معك ',
                ]]);
            }else{
                if($request->hasFile('doc')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['doc'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/users_verify/' , $file_name);
              $photo='users_verify/'.$file_name;
                }else{
                    $photo=Null;
                }
                $verify=Verify_store::create([
                    'user_id'=>auth::user()->id,
                    'type'=>$request['type'],
                    'name'=>$request['name'],
                    'documentNumber'=>$request['numberAsString'],
                    'notes'=>$request['comment'],
                    'photo'=>$photo,
                    ]);
                    return redirect()->route('user_profile',auth::user()->id)->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text' => 'سيتم التواصل معك ',
                    ]]);
            }

        }
        return back();
    }
    public function add_identify(Request $request){
                      $rules= [
            'store_identify' => 'required|unique:users'
                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
        $user=User::find(auth::user()->id);
        $user->store_identify=$request['store_identify'];
        $user->save();
            return redirect()->route('user_profile',auth::user()->id)->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text'=>'تم اضافه المعرف بنجاح'
                    ]]);
    }
    public function edit_map(){
        return view('site.user.edit_map');
    
    }
    public function update_user_store_map(Request $request){
     $user =auth::user();
     $user->latstore=$request['latStore'];
     $user->lngstore=$request['lngStore'];
     $user->address_store=$request['address'];
     $user->save();
       
     return redirect()->route('edit_store',$user->id)->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text' => 'سيتم التواصل معك ',
                    ]]);
    }
    
    public function update_user_store(Request $request){
       $user=auth::user();
              if($request->hasFile('avatar')){ 
                  $str=rand();
                      $result = md5($str);
                      $file =$request['avatar'];
                      $file_name = time() . $result . $file->getClientOriginalName();
                      $file->move(base_path() . '/public/storage/users/' , $file_name);
                $avatar='users/'.$file_name;
                 $user->update(['avatar'=>$avatar]);
            }
                  if($request->hasFile('cover')){ 
                  $str=rand();
                      $result = md5($str);
                      $file =$request['cover'];
                     
                      $file_name = time() . $result . $file->getClientOriginalName();
                      $file->move(base_path() . '/public/storage/users/' , $file_name);
                $cover='users/'.$file_name;
                
                     $user->update(['cover'=>$cover]);
            }
    

     $user->update(['description_store'=>$request['description']]);
     $user->save;
    //   dd($request,$user) ;  
     $contacts=UserContact::where('user_id',auth::user()->id)->get();
     foreach($contacts as $contact){
         $contact->delete();
     }
     if(!empty($request['contact'])){
     foreach($request['contact'] as $con){
         UserContact::create(['user_id'=>auth::user()->id,'contact'=>$con]);
     }
     }
     return redirect()->route('user_profile',$user->id)->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text' => 'تم التعديل بنجاح ',
                    ]]);
    }
    
    public function update_user($type){
        $type=$type;
       $user=auth::user();
       $is_pay=1;
         foreach($user->user_posts as $post){
        if($post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
    }
        return view('site.user.update',compact('type','user','is_pay'));
    }
    public function edit_user(Request $request,$type){
        
        $user=auth::user();
        if($type=='name'){
            $user->update(['name'=>$request['name']]);
        }elseif($type=='email'){
            $user->update(['email'=>$request['email']]);
        }elseif($type=='phone'){
            
           if (!preg_match('/^966(5[0-9]{8}|1[0-9]{7})$/', $request['phone'])) {
              
           return redirect()->back()->with(['alert' => [
                    'icon' => 'error',
                    'title' =>'فشل',
                    'text' => 'رقم الهاتف يجب ان يكون سعودي',
                ]]); 
           }

            
         $user->update(['phone'=>$request['phone']]);
             
        $phones=auth()->user()->phones;
        foreach ($phones as $phone){
            UserPhone::where('id',$phone->id)->delete();
        }
        UserPhone::create(
            [
                'user_id'=> auth()->id(),
                'number'=> $request['phone']
            ]
        );
            
             
             
        }elseif($type=='password'){
         $user->update(['password'=>Hash::make($request['newPass'])])   ;
        }
             return redirect()->route('user_profile',$user->id)->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text' => 'تم التعديل بنجاح ',
                    ]]);
    }
    public function change_password(Request $request){
        if(Hash::check($request['pass'], auth::user()->password)){
            $type='password';
            $user=auth::user();
            $is_pay=1;
                 foreach($user->user_posts as $post){
        if($post->post->is_pay==0){
            $is_pay=0;
        }else{
            $is_pay=1;
        }
        }
                         return view('site.user.update',compact('type','user','is_pay'));
        }else{
           return redirect()->back()->with(['alert' => [
                        'icon' => 'error',
                        'title' =>'تأكد من كلمة المرور',
                        'text' => 'حدث خطأ',
                    ]]);
        }
    }
    public function admin_edit_user($id,Request $request){
        $user=User::find($id);
        $user->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'phone'=>$request['phone']
            ]);
                   return redirect()->back()->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم بنجاح',
                        'text' => 'تم التعديل بنجاح ',
                    ]]);
    }
}
