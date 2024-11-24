<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Area;
use App\Models\PostImages;
use App\Models\User_posts;
use App\Models\Comment;
use Validator;
use Auth;
use Image;
use File;
use Carbon\Carbon;
use App\Models\setting;
use App\Notifications\activeNotification;
use App\Models\User;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function del_post_user($id){
         Post::find($id)->delete();
                return redirect()->route('user_profile',auth::user()->id)->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم الحذف',
        'text' => 'تم الحذف بنجاح'
    ]]);
     }
    public function index()
    {   
      \Illuminate\Support\Facades\DB::table('posts')->update(['deleted_at' => NULL]);

       $posts=Post::get();
        return view('admin.posts.index',compact('posts'));
    }
    public function showNot($id){
         $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
         $posts=Post::get();
        return view('admin.posts.index',compact('posts'));
    }
  public function active($id){
       $post=Post::find($id);
       if($post->active==0){
           $post->active=1;
           $title="تم تفعيل الأعلان";
       }else{
           $post->active=0;
          $title="تم إلغاء تفعيل الأعلان";
          $post->why_unactive=request('reason');
       }
       $post->save();
        $user=$post->post_user->User;
        $user->notify(new activeNotification($post,$title));
       return redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>$title,
        'text' => 'تم بنجاح',
    ]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cats=Cat::get();
        $areas=Area::where('parent_id',null)->get();
        return view('admin.posts.create',compact('cats','areas'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules= [
            'file.*'=>'mimes:jpg,JPG,bmp,png,mp4,avi,mpeg,flv'
                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails()) {
                                             return redirect()->back()->with(['alert' => [
        'icon' => 'error',
        'title' =>$validate->messages()->all()[0],
        'text' => ''
    ]]);
                  }
        if($request->title_en==null){
            $title_en=$request->title_ar;
        }
        else{
            $title_en=$request->title_en;
        }
        if($request->cat ==null){
            $cat_id=$request->parent_id;
        }else{
            $cat_id=$request->cat;
        }
            $comm=setting::where('name','cmshn')->first()->value;

         if($request->price==true){
    $price=$request->priceValue;
    $commission=($price*$comm)/100;
    }else{
        $price=0;
        $commission=Null;
    }
        if($request->noContact){
        $contact=2;
        $mobile=NULL;
    }else{
        $contact=1;
        $mobile=$request['contact'];
    }

        $outlets = Post::all();
        // // dd($outlets);
        // $geoJSONdata = $outlets->map(function ($outlet) {
        //     return [
        //         'type'       => 'Feature',
        //         'properties' => new OutletResource($outlet),
        //         'geometry'   => [
        //             'type'        => 'Point',
        //             'coordinates' => [
        //                 $outlet->lng,
        //                 $outlet->lat,
        //             ],
        //         ],
        //     ];
        // });
        // return response()->json([
        //     'type'     => 'FeatureCollection',
        //     'features' => $geoJSONdata,
        // ]);


            $area=Area::where('id',$request->area_id)->first();
            $lat=$area->lat;
            $lang=$area->lng;

       $post =Post::create([
        'title_ar'=>$request->title_ar,
        'title_en'=>$title_en,
        'cat_id'=>$cat_id,
        'area_id'=>$request->area_id,
        'special_id'=>auth::user()->member_id,
        'km'=>$request->km,
        'price'=>$price,
        'model'=>$request->model,
        'use_status'=>$request->condition,
        'post_type'=>$request->typeOfPost,
        'fuel_type'=>$request->fuel,
        'bank_id'=>$request->leaseSourse,
        'gear_type'=>$request->gear,
        'double'=>$request->double,
        'description'=>$request->description,
        'mobile'=>$mobile,
        'active'=>0,
        'lat'=>$lat,
        'lng'=>$lang,
        'contact'=>$contact,
        'commission'=>$commission,
        'is_pay'=>0,
    ]);
        $postUser=User_posts::create([
            'post_id'=>$post->id,
            'user_id'=>auth::user()->id
        ]);
            // dd($request->hasFile('file'));
        if($request->hasFile('file')){
            $i=0;
        foreach($request->file as $img){
            $str=rand();
                $result = md5($str);
                $ex=$img->getClientOriginalExtension();
                $file =$img;

          if($ex=='png' || $ex=='PNG' || $ex=='jpg' ||$ex=='JPG'||$ex=='svg' || $ex=='SVG' ||$ex=='bmp' ||$ex=='BMP' ||$ex=='gif' ||$ex=='GIF' || $ex=='HEIF' || $ex=='heif'){
                $this->waterMark($img,$i+1,$post->id);
                $type=0;
          }elseif($ex=='mp4' || $ex=='MP4' || $ex=='flv'||$ex=='avi'||$ex=='mpeg' || $ex='HEVC' ||  $ex='MP2T' || $ex == 'hevc' || $ex == 'mkp' || $ex == 'MOV' || $ex == 'WMV' || $ex == 'MKV' || $ex == 'MPEG-2' || $ex == 'AVI'){
              if($file->getSize() < 5000){
              $type=1;
              $file_name = time() . $result . $file->getClientOriginalName();
              $file->move(base_path() . '/public/storage/posts/',$file_name);
              $avatar='posts/'.$file_name;
              }else{
                return redirect()->back()->with(['alert' => [
                    'icon' => 'error',
                    'title' =>'خطا !',
                    'text' => 'حجم الفيديو لا يمكن ان يكون اكبر من 5 ميجابايت'
                ]]);
              }
        $i++;
       $imgPost=PostImages::create([
              'image'=>$avatar,
              'type'=>$type,
              'sort'=>$i,
              'post_id'=>$post->id,
       ]);
          }


      }
    }
    return redirect()->route('posts.index')->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم الاضافه',
        'text' => 'تم اضافه الاعلان بنجاح'
    ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $post=$post;
        $cats=Cat::all();
        $areas=Area::get();


        return view('admin.posts.update',compact('post','cats','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        // dd($request);
        $post=$post;
        if(isset($request['title_en'])){
        if($request->title_en==null){
            $title_en=$request->title_ar;
        }
        else{
            $title_en=$request->title_en;
        }}else{
            $title_en=$request->title_en;
        }

 $comm=setting::where('name','cmshn')->first()->value;

         if($request->price==true){
    $price=$request->priceValue;
    $commission=($price*$comm)/100;
    }else{
        $price=0;
        $commission=Null;
    }
            $area=Area::where('id',$request->area_id)->first();
            $lat=$area->lat;
            $lang=$area->lng;

        $post->update([
            'title_ar'=>$request->title_ar,
            'title_en'=>$title_en,
            'cat_id'=>$request['cat'],
            'area_id'=>$request->area_id,
             'price'=>$price,
            'description'=>$request->description,
            'active'=>0,
            'lat'=>$lat,
            'lng'=>$lang,
        ]);
        return redirect()->route('posts.index')->with(['alert' => [
            'icon' => 'success',
            'title' =>'تمت التعديل',
            'text' => 'تم تعديل الاعلان بنجاح'
        ]]);
    }

    public function edit_map($id){
      $post=Post::find($id);
      return view('admin.posts.edit_map',compact('post'));
    }
    public function update_post_map(Request $request,$id){

        $post=Post::find($id);
        $area=Area::where([  'lat'=>$request->latitude,
        'lng'=>$request->longitude])->first();
        if(empty($area)){
            $area=Area::create([
                'lat'=>$request['latitude'],
        'lng'=>$request['longitude'],
        'name_ar'=>$request['pac-input'],
        'name_en'=>$request['pac-input']
            ]);
        }
        $post->update([
            'lat'=>$request->latitude,
            'lng'=>$request->longitude,
        ]);
        return redirect()->route('posts.index')->with(['alert' => [
            'icon' => 'success',
            'title' =>'تمت التعديل',
            'text' => 'تم تعديل مكان الاعلان على الخريطه بنجاح'
        ]]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post,$id)
    {
        //
        $images=PostImages::where('post_id',$id)->get();
        foreach($images as $img){
            $image_path =base_path() . '/public/storage/'.$img->image;
            // dd($image_path);
             if (File::exists($image_path)) {
                unlink($image_path);
            }
            $img->delete();
        }
        Post::find($id)->delete();
        return  redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الحذف',
            'text' => 'تم حذف الاعلان بنجاح'
        ]]);
    }
    //===================== post images ===================
    public function post_images($id){
        $images=PostImages::where('post_id',$id)->get();
        $post=Post::find($id);
        return view('admin.posts.images',compact('images','post'));
        }
 public function del_image($id){
    $img= PostImages::where('id',$id)->first();
    $image_path =base_path() . '/public/storage/'.$img->image;
    // dd($image_path);
     if (File::exists($image_path)) {
        unlink($image_path);
    }
    $img->delete();
     return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>' تم الحذف',
        'text' => 'تم حذف الصورة بنجاح'
    ]]);
 }
 public function add_image(Request $request,$id){
     if($request->hasFile('file')){
     $img=$request->file;
         $str=rand();
             $result = md5($str);
             $ex=$img->getClientOriginalExtension();
            //  dd($ex);
       if($ex=='jpeg' || $ex=='JPEG' || $ex=='png' || $ex=='PNG' || $ex=='jpg' ||$ex=='JPG'||$ex=='svg' || $ex=='SVG' ||$ex=='bmp' ||$ex=='BMP' ||$ex=='gif' ||$ex=='GIF' || $ex=='HEIF' || $ex == 'heif'){
           $type=0;
           $this->waterMark($img,$request->sort,$id);
       }elseif($ex=='mp4' || $ex == 'MP4' || $ex=='flv'||$ex=='avi'||$ex=='mpeg' || $ex == 'HEVC' || $ex == 'MP2T'){
           $type=1;
           $file =$img;
           $file_name = time() . $result . $file->getClientOriginalName();
           $file->move(base_path() . '/public/storage/posts/' , $file_name);
     $avatar='posts/'.$file_name;
     if($request->sort){
         $sort=$request->sort;
     }else{
         $sort=1;
     }

           $imgPost=PostImages::create([
            'image'=>$avatar,
            'type'=>$type,
            'sort'=>$request->sort,
            'post_id'=>$id,
     ]);
       }


     }
     return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تمت الاضافه',
        'text' => 'تم اضافة الصورة بنجاح'
    ]]);
 }
 public function update_img($id,Request $request){
     $img=PostImages::find($id);
     $img->update(['sort'=>$request->sort]);
     return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم التعديل',
        'text' => 'تم تعديل ترتيب الصورة بنجاح'
    ]]);
 }
 public function enable_post_comment($id){
     $post=Post::find($id);
     if($post->comment==1){
         $post->comment=0;
     }else{
        $post->comment=1;
     }
     $post->save();
     return redirect()->back();
 }
 public function show_comment($id){
     $comments=Comment::where('post_id',$id)->get();
     $post=Post::find($id);
     return view('admin.posts.comment',compact('comments','post'));
 }
 public function del_comment($id){
    Comment::find($id)->delete();
    return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم الحذف',
        'text' => ' تم حذف التعليق  بنجاح'
    ]]);
 }
 // watermark

public function waterMark($img,$sort,$post_id){
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
    $imgPost=PostImages::create([
        'image'=>$avatar,
        'type'=>0,
        'sort'=>$sort,
        'post_id'=>$post_id,
 ]);


}
public function is_pay($id){
    $post=Post::find($id);
    if($post->is_pay==0){
        $post->is_pay=1;
    }else{
        $post->is_pay=0;
    }
    $post->save();
    return redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم ',
        'text' => 'تم بنجاح',
    ]]);
}

}


