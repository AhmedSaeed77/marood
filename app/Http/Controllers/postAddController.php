<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Post;
use App\Models\Area;
use App\Models\photos_session;
use App\Models\PostImages;
use App\Models\User_posts;
use App\Models\Comment;
use App\Models\HarajBank;
use App\Models\followCat;
use App\Models\Follow_user;
use Validator;
use Auth;
use Image;
use File;
use App\Models\setting;
use Session;
use Illuminate\Http\UploadedFile;
use App\Notifications\postFollowNotification;
use App\Notifications\commentNotification;
use App\Notifications\addPostNotfication;
class postAddController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('verified');
    }
    // ==============add post==============
    public function choose_cat_add_post(){
        $cats=Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get();
        $mainFilter=\App\Models\menues::find(4);
        $settingUser=setting::where('name','maxPostInDay')->first()->value;
        $grasLink=setting::where('name','garas_link')->first()->value;
        $settingUserVim=setting::where('name','maxPostInDayVim')->first()->value;
          if(auth::user()->hasRole(['admin','superAdmin'])){
             return view('site.addPost.chooseCat',compact('cats','mainFilter','grasLink'));
        }
        if(auth::user()->active==1 ){
            // $date=date('Y-m-d');
            // $posts=auth::user()->user_posts()->whereDate('user_posts.created_at',$date)->count();
            
             $date=date('Y-m-d');
             $month=date('m');

                if(auth::user()->member_id==null){
                    $posts=auth::user()->user_posts()->whereMonth('user_posts.created_at',$month)->count();
                }else{
                    $posts=auth::user()->user_posts()->whereDate('user_posts.created_at',$date)->count();
                }
                 if(auth::user()->member_id==null){
                    if($posts > $settingUser || $posts == $settingUser){
                        
                          return view('site.addPost.maxInDay');
                    }else{
                      return view('site.addPost.chooseCat',compact('cats','mainFilter','grasLink'));

                    }

                 }else{
                    if($posts > $settingUserVim || $posts == $settingUserVim){
                          return view('site.addPost.maxInDay');

                    }else{
                    return view('site.addPost.chooseCat',compact('cats','mainFilter','grasLink'));

                    }
                 }

        }else{
            return redirect()->back()->with(['alert' => [
                'icon' => 'error',
                'title' =>'عفوا لا يمكنك اضافه اعلان',
                'text' => ' يجب تفعيل الحساب',
            ]]);
        }

     }

    public function contract_add_post($id){
      $cat=Cat::find($id);
     return view('site.addPost.contract',compact('cat'));
    }

    public function choose_area_add_post($id){
     $cat=Cat::find($id);
     $areas=Area::where('parent_id',null)->get();
     return view('site.addPost.area',compact('cat','areas'));
    }

    public function choose_photo_add_post(Request $request, $cat_id, $area_id){
        $cat=Cat::find($cat_id);
        $parent=$cat;
        if($parent->parent_id != null){
         while(!empty($parent->parent)){
            $parent=$parent->parent;
            }

        }
        $area=Area::find($area_id);

        if($cat->id == 5 && $area->parent_id != null){
        $areas=Area::where('parent_id',$area_id)->where('is_area','=',1)->get();

        }else{
        $areas=Area::where('parent_id',$area_id)->where('is_area','=',0)->get();

        }
        if(count($areas) > 0){
            return view('site.addPost.area',compact('cat','areas','parent'));
        }elseif( is_null($request->lng) || is_null($request->lat)){
            if($cat->id == '5' || $cat->id == '4033' || $cat->id == '4034'){
                return view('site.addPost.map',compact('cat','area','parent'));
            }else{
                return view('site.addPost.photos',compact('cat','area','parent'));
            }
        }else{
            if( !is_null($request->lng) && !is_null($request->lat)){
                $location = [];
                $location['lat']=$request->lat;
                $location['lng']=$request->lng;
                return view('site.addPost.photos',compact('cat','area','parent', 'location'));
            }else{
                return view('site.addPost.photos',compact('cat','area','parent'));
            }
        }
    }

    public function add_post_photo_infos(Request $request ,$cat_id,$area_id){
        $cats=Cat::where('parent_id',NULL);
        $cat=Cat::find($cat_id);
        $area=Area::find($area_id);
        $parent=$cat;
        if($parent->parent_id != null){
         while(!empty($parent->parent)){
            $parent=$parent->parent;
            }

        }
        if(session()->has('photos_session')){
            session()->forget('photos_session');
        }


            $photos_session = new photos_session();
                if($request->hasFile('front')){

                foreach($request->front as $imgF){
                        $this->add_img_session($imgF,1);
                    }
                 }
                if($request->hasFile('inside')){
                    foreach($request->inside as $imgI){
                            $this->add_img_session($imgI,3);
                        }
                    }
                if($request->hasFile('other')){
                foreach($request->other as $imgO){
                        $this->add_img_session($imgO,4);
                    }
                    }
                if($request->hasFile('side')){
                    foreach($request->side as $imgS){
                        $this->add_img_session($imgS,2);
                    }
                }
                if($request->hasFile('all')){
                    foreach($request->all as $imgA){
                            $this->add_img_session($imgA,1);
                    }
                }
                if($request->hasFile('videos')){
                    foreach($request->videos as $vid){
                            $this->add_video_session($vid,4);
                    }
                }


                $model=setting::where('name','modelNumber')->first()->value;
                $banks=HarajBank::get();
                if( !is_null($request->lng) && !is_null($request->lat)){
                    $location = [];
                    $location['lat']=$request->lat;
                    $location['lng']=$request->lng;
                    return view('site.addPost.mainInfo',compact('cat','cats','area','parent','model','banks','location'));
                }else{
                    return view('site.addPost.mainInfo',compact('cat','cats','area','parent','model','banks'));
                }
    }
    //image
    public function add_img_session($img,$sort){

        $str=rand();
        $result = md5($str);
        $ex=$img->getClientOriginalExtension();
        $file =$img;
        if($ex=='jpeg' || $ex=='JPEG' || $ex=='png' || $ex=='PNG' || $ex=='jpg' ||$ex=='JPG' ||$ex=='bmp' ||$ex=='BMP' ||$ex=='gif' ||$ex=='GIF' || $ex=='HEIF' || $ex=='heif'){
            $type=0;
            $avatar=$this->waterMark($img);
        }else{
            return redirect()->back()->with(['alert'=>[
                'icon'=>'error'    ,
                'title'=>'خطأ!',
                'text'=>'امتداد الصورة يجب ان يكون:png,jpg,svg,bmp,gif,mp4,flv,avi,mpeg'
                ]]);
        }

        $imgS=[
        'name'=>$avatar,
        'type'=>$type,
        'sort'=>$sort,
        ];
        $photos_session = new photos_session(session()->get('photos_session'));

        $photos_session->add($imgS);
        session()->put('photos_session' , $photos_session);

    }
    //Video
     public function add_video_session($vid,$sort){

        $str=rand();
        $result = md5($str);
        $ex=$vid->getClientOriginalExtension();
        $file =$vid;
        if($ex=='mp4' || $ex=='MP4' || $ex=='flv'||$ex=='avi' || $ex == 'AVI' ||$ex=='mpeg' || $ex='HEVC' || $ex == 'hevc'  ||  $ex='MP2T' || $ex == 'mkp' || $ex == 'MOV' || $ex == 'WMV' || $ex == 'MKV' || $ex == 'MPEG-2' ){
            $type=1;
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/posts/' , $file_name);
            $avatar='posts/'.$file_name;
        }else{
            return redirect()->back()->with(['alert'=>[
                'icon'=>'error'    ,
                'title'=>'خطأ!',
                'text'=>'امتداد الفيديو يجب ان يكون:mp4,flv,avi,mpeg,hevc,mp2t,mkp,mov,wmv,mpeg-2,'
                ]]);
        }

        $imgS=[
        'name'=>$avatar,
        'type'=>$type,
        'sort'=>$sort,
        ];
        $photos_session = new photos_session(session()->get('photos_session'));

        $photos_session->add($imgS);
        session()->put('photos_session' , $photos_session);

    }

    // watermark

public function waterMark($img){
    /* insert watermark at bottom-right corner with 10px offset */
    $str=rand();
                $result = md5($str);
    $x=Image::make($img);
    $s=setting::where('for','wm')->get();
    $width=Image::make($x)->width();
    $height=Image::make($x)->height();

  if($s->where('name','vm_active')->first()->value==1){
      if(setting::where('name','WM_type')->first()->value==0){
          $mb=($width*75)/100;
          $mr=($height*85)/100;
        //   dd($mb,$mr,$width,$height);
         $text=setting::where('name','vm_text')->first()->value;
        if($this->contains_arabic($text)){
        $text=$this->word2uni(setting::where('name','vm_text')->first()->value);
        }else{
          $text=setting::where('name','vm_text')->first()->value;
        }
        $x->text($text, $mb, $mr, function ($font) {

            $font->file(public_path('admin/assets/fonts/Tajawal-Bold.ttf'));
            $font->size(setting::where('name','vm_fontSize')->first()->value);
            $font->color(setting::where('name','WM_strColor')->first()->value);
        });
      }
       else{
            $photo=$s->where('name','WM_img')->first()->value;
            $ww=$width/3;
            $hh=($height/4);

            $m=Image::make(base_path() . '/public/storage/'.$photo)->resize($ww,$hh);
            $mb=intval((5*$width)/100);
            $mr=intval((5*$height)/100);

            $x->insert($m, 'bottom-right',$mb, $mr);
        }
     }
    $file_name = time() . $result . $img->getClientOriginalName();
    $x->save(base_path() . '/public/storage/posts/'.$file_name);
    $avatar='posts/'.$file_name;
   return $avatar;
}


   public function store_post(Request $request,$area_id){

    // if(is_null($request->cat)){
    //     return redirect('choose/cat/add/post')->with(['alert'=>['icon'=>'error','title'=>'خطأ','text'=>'يجب اختيار القسم الفرعى']]);
    // }

    if($request->title_en==null){
        $title_en=$request->title_ar;
    }
    else{
        $title_en=$request->title_en;
    }

    if($request->cat_id ==null){
        $cat_id=$request->parent_id;
    }else{
        $cat_id=$request->cat_id;
    }

    if($request->noContact){
        $contact=2;
        $mobile=NULL;
    }else{
        $contact=1;
        $mobile=$request['contact'];
    }
    $comm=setting::where('name','cmshn')->first()->value;
    $price_type = $request->price;

    $price=$request->priceValue;
    $commission=($price*$comm)/100;

        $area=Area::where('id',$area_id)->first();
        $lat=$area->lat;
        $lang=$area->lng;
    $post =Post::create([
        'title_ar'=>$request->title_ar,
        'title_en'=>$title_en,
        'cat_id'=>  $request->cat??$request['cat_id'],
        'spare_id'=> !is_null($request->spares) ? json_encode($request->spares) : NULL,
        'brands_id'=> !is_null($request->brands) ? json_encode($request->brands) : NULL,
        'area_id'=>$request->area_id,
        'km'=>$request->km,
        'price'=>$price,
        'price_type' => $price_type,
        'model'=>$request->model,
        'use_status'=>$request->condition,
        'post_type'=>$request->typeOfPost,
        'fuel_type'=>$request->fuel,
        'bank_id'=>$request->leaseSourse,
        'gear_type'=>$request->gear,
        'double'=>$request->double,
        'description'=>$request->description,
        'mobile'=>$mobile,
        'active'=>1,
        'lat'=> !is_null($request->lat) ? $request->lat : $lat   ,
        'lng'=> !is_null($request->lng) ? $request->lng : $lang,
        'contact'=>$contact,
        'commission'=>$commission,
        'is_pay'=>0,
        
        ######### Real Sate information ##############
        'street' => $request->street,
        'space' => $request->space,
        'age_of_state' => $request->age_of_state,
        'destination' => $request->destination,
        'street_width' => $request->street_width,
        'rooms_number' => $request->rooms_number,
        'number_of_halls' => $request->number_of_halls,
        'number_of_bathrooms' => $request->number_of_bathrooms,
        'villa_type' => $request->villa_type,
        'additional_options' => json_encode($request->additional_options),
    ]);
    if(auth::user()->member_id!=null){
        $post->special_id=auth::user()->member_id;
        $post->save();
    }
    $postUser=User_posts::create([
        'post_id'=>$post->id,
        'user_id'=>auth::user()->id
    ]);
    $users=User::get();
    foreach($users as $user){
       if($user->hasAnyRole('admin', 'superAdmin')){
            $user->notify(new addPostNotfication($post,' لقد قام '.auth::user()->name.'بإضافة أعلان جديد '));
       }
    }

    if(session()->has('photos_session') and count(session()->get('photos_session')->items)>0){
            foreach(session()->get('photos_session')->items as $item){
            $imgPost=PostImages::create([
                'image'=>$item['name'],
                'type'=>$item['type'],
                'sort'=>$item['sort'],
                'post_id'=>$post->id,
        ]);
            }
        }
     $this->sendNotification($post);
    session()->forget('photos_session');
    return redirect()->route('single_post',$post->id);
   }


   public function sendNotification(Post $post){
    $usersfollowUser=Follow_user::where('follow_user_id',auth::user()->id)->get();
    $parent=[];
    $child=Cat::where('parent_id',$post->cat_id)->pluck('id')->toArray();
    $parent=array_merge($parent,$child);
    if(!empty($child)){
    while (!empty($child)) {
        $child=Cat::whereIn('parent_id',$child)->pluck('id')->toArray();
        $parent=array_merge($parent,$child);
    }
    }else{
        $parent=[$post->cat_id];
    }
    $usersfollowCat=followCat::whereIn('cat_id',$parent)->get();
    $followUserTitle='يوجد اعلان جديد لمعلن تتابعة';
    $followCatTitle='يوجد اعلان جديد لقسم تتابعة';
    foreach($usersfollowUser as $userF){
        $user=$userF->user;
        $user->notify(new postFollowNotification($post,$followUserTitle,1));
    }
    foreach($usersfollowCat as $catF){
        $user=$catF->user;
        $user->notify(new postFollowNotification($post,$followCatTitle,2));
    }

   }
   public function update_single_user_post(Request $request,$id){
        if(is_null($request->cat)){
            return redirect()->back()->with(['alert'=>['icon'=>'error','title'=>'Error','text'=>'يجب اختيار القسم الفرعى']]);
        }
        if($request->title_en==null){
            $title_en=$request->title;
        }
        else{
            $title_en=$request->title_en;
        }
        // dd($title_en);
       $post=Post::find($id);
       $post->update([
           'title_ar'=>$request['title'],
       'title_en'=>$title_en,
       'description'=>$request['desc'],
       'cat_id'=>$request['cat'],
       
        ######### Real Sate information ##############
       'street' => $request->street,
       'space' => $request->space,
       'age_of_state' => $request->age_of_state,
       'destination' => $request->destination,
       'street_width' => $request->street_width,
       'rooms_number' => $request->rooms_number,
       'number_of_halls' => $request->number_of_halls,
       'number_of_bathrooms' => $request->number_of_bathrooms,
       'villa_type' => $request->villa_type,
       'additional_options' => json_encode($request->additional_options),
       ]);
       if(!is_null($request['lat']) && !is_null($request['lng']) ){
        $post->update([
            'lat'=>$request['lat'],
            'lng'=>$request['lng'],
        ]);
       }
       if($request['mobile']==null){
        $post->update([
            'mobile'=>null,
            'contact'=>2,
        ]);
       }else{
        $post->update([
            'mobile'=>$request['mobile'],
            'contact'=>1,
        ]);
       }
       if($request->hasFile('photos')){
        //   $postImges=PostImages::where('post_id',$id)->get();
        //   foreach($postImges as $img){
        //     $image_path =base_path() . '/public/storage/'.$img->image;
        //     // dd($image_path);
        //      if (File::exists($image_path)) {
        //         unlink($image_path);
        //     }
        //     $img->delete();
        //   }
        foreach($request->photos as $i=>$photo){
            $avatar=$this->waterMark($photo);
            PostImages::create([
                'type'=>0,
                'image'=>$avatar,
                'sort'=>$i,
                'post_id'=>$id
            ]);
         }
        }
        if($request->hasFile('videos')){
        foreach($request->videos as $x=>$video){
            // Size 5000000 bytes equal 5000 kilobyte equal 5 megabyte
            if($video->getSize() < 5000000){
            $file =$video;
            $str=rand();
            $result = md5($str);
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/posts/' , $file_name);
            $avatar='posts/'.$file_name;
            PostImages::create([
                'type'=>1,
                'image'=>$avatar,
                'sort'=>$x,
                'post_id'=>$id
            ]);
            }else{
                return redirect()->back()->with(['alert'=>[
                    'icon'=>'error'    ,
                    'title'=>'خطأ!',
                    'text'=>'لا يمكن ان يكون حجم الفيديو اكبر من 5 ميجابايت'
                ]]);
            }
         }
        }
         return redirect()->route('single_post',$id);

   }

   public function delete_image($id){
       

            $img = PostImages::find($id);
            $image_path =base_path() . '/public/storage/'.$img->image;
            // dd($image_path);
             if (File::exists($image_path)) {
                unlink($image_path);
            }
            $img->delete();

           return response()->json(['alert'=>[
               'icon'=>'success',
               'title'=>__('site.success'),
               'text'=>__('site.delete file'),
               ]]);
   }

}
