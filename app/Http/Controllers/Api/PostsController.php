<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Area;
use App\Models\Post;
use App\Models\PostImages;
use App\Models\postInfraction;
use App\Models\setting;
use App\Models\User_posts;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class PostsController extends Controller
{
    use ApiTrait , HelperTrait;

    public function index() {

        $postsIds = Auth::user()->user_posts;
//        return $this->sendResponse('success',new PostCollection($postsIds));
//        $posts = new Collection();
//        foreach ($postsIds as $post){
//            $posts->push(Post::find($post['post_id']));
//        }
        return $this->sendResponse('success' , PostResource::collection($postsIds));
    }

    public  function  SimillarPosts(PostRequest $request){
        $post=Post::find($request->post_id);
        $posts=Post::where('cat_id',$post->cat_id)->where('area_id',$post->area_id)->where('id','!=',$post->id)->get();
        return $posts->count()>0?$this->sendResponse('success' , PostResource::collection($posts)):$this->sendResponse(__('site.There are no simillar posts') , []);
    }
    public function DeleteAll(){
        $posts=Post::all();
        foreach ($posts as $post){
            $post->delete();
        }
        return $this->sendResponse('success' , 'All Posts Deleted Successfully');
    }
    
    
    
    public function store(AddPostRequest $request) {

        $lat=null;
        $lang=null;
        $commRate = setting::where('name' , 'cmshn')->first()->value ?? 0.9;
        $contact = 1;
        $mobile = null;
        $commission = NULL;
        if($request['price']){
            $commission = ($request['price'] * $commRate) / 100 ;
        }else{  $request['price'] = 0;  }
        $request['title_en'] ?? $request['title_ar'];

        if ($request['contact'] == 2) {
            $contact = 2;
            $mobile = $request['mobile'];
        }
        if ($request->area_id){
            $area=Area::where('id',$request->area_id)->first();
            $lat=$area->lat;
            $lang=$area->lng;
        }
        $validator = Validator::make($request->all(), [
            'images.*' => 'image|max:5120', // Maximum file size for each image is 2048 kilobytes (2 megabytes)
        ]);
        if ($validator->fails()){
            return $this->sendFailedMessage(__('site.maxsize'));
        }
        
        
        
         $date=date('Y-m-d');
         $month=date('m');
         $is_max_length_posts = 0;
         $settingUser=setting::where('name','maxPostInDay')->first()->value;
         $settingUserVim=setting::where('name','maxPostInDayVim')->first()->value;


        if(auth::user()->member_id==null){
            $posts=auth::user()->user_posts()->whereMonth('user_posts.created_at',$month)->count();
        }else{
            $posts=auth::user()->user_posts()->whereDate('user_posts.created_at',$date)->count();
        }
         if(auth::user()->member_id==null){
            if($posts > $settingUser || $posts == $settingUser){
              $is_max_length_posts = 1;
            }else{
                 $is_max_length_posts = 0;
            }

         }else{
            if($posts > $settingUserVim || $posts == $settingUserVim){
                 $is_max_length_posts = 1;
            }else{
             $is_max_length_posts = 0;
            }
         }
         
         
      if( $is_max_length_posts == 1){
        return $this->sendFailedMessage(__('تم الوصول للحد الاقصي لاضافه الاعلانات'),201);

        }
        
        
        $post = Post::create([
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'cat_id'=>  $request->cat_id,
            'spare_id'=> !is_null($request->spares) ? json_encode($request->spares) : NULL,
            'brands_id'=> !is_null($request->brands) ? json_encode($request->brands) : NULL,
            'area_id'=>$request->area_id,
            'km'=>$request->km,
            'price'=>$request->price,
            'price_type'=>$request->price_type,
            'model'=>$request->model,
            'use_status'=>$request->use_status,
            'post_type'=>$request->post_type,
            'fuel_type'=>$request->fuel_type,
            'bank_id'=>$request->bank_id,
            'gear_type'=>$request->gear_type,
            'double'=>$request->double,
             'color'=>$request->color,
            'description'=>$request->description,
            'mobile'=>$mobile,
            'active'=>1,
            'lat'=> $lat,
            'lng'=> $lang,
            'contact'=>$contact,
            'commission'=>$commission,
            'is_pay'=> 0 ,
            'Show_on_map' => $request['show_on_map'],
            'advertiser_status'=>$request->advertiser_status,
            'commercial_advertiser_number'=>$request->commercial_advertiser_number,
            'street_type'=>$request->street_type,
            'direction'=>$request->direction,
            'place'=>$request->place,
            'more_details'=>$request->more_details,
            
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

        User_posts::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post['id']
        ]);

        if($files=$request->file('images')){
            foreach ($files as $file){

    $name = $this->upload($file , 'posts/');
                PostImages::create([
                    'image' => 'posts/' . $name ,
                    'type' => 0,
                    'post_id' => $post['id'],
                    'sort' => 1
                ]);
            }
        }

        if($files=$request->file('videos')){
            foreach ($files as $file){
                $name = $this->upload($file , 'posts/');
                PostImages::create([
                    'image' => 'posts/' . $name ,
                    'type' => 1,
                    'post_id' => $post['id'],
                    'sort' => 1
                ]);
            }
        }

        return $this->sendMessageResponse(__('site.Post Created'));
        
        
        


    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->post_user->user->id != Auth::user()->id){
            return abort(403);
        }

        $commistion = setting::where('name','cmshn')->first()->value;
        if($request->price){
            $price=$request->price;
            $commission=($price * $commistion) / 100;
        }else{
            $price=0;
            $commission=Null;
        }
        if ($request->area){
            $area=Area::where('id',$request->area_id)->first();
            $lat=$area->lat;
            $lang=$area->lng;
        }

        $contact = $request['contact'] ?? $post['contact'];
        $mobile = $post['mobile'];
        if ($contact == 2) {
            $mobile = $request['mobile'];
        }

        if($files=$request->file('images')){
            $post->postImages()->delete();
            foreach ($files as $file){
                $name = $this->upload($file , 'posts/');
                PostImages::create([
                    'image' => 'posts/' . $name ,
                    'type' => 0,
                    'post_id' => $post['id'],
                    'sort' => 1
                ]);
            }
        }else {
            $post->postImages()->delete();
        }


        if($files=$request->file('videos')){
            $post->postVideos()->delete();
            foreach ($files as $file){
                $name = $this->upload($file , 'posts/');
                PostImages::create([
                    'image' => 'posts/' . $name ,
                    'type' => 1,
                    'post_id' => $post['id'],
                    'sort' => 1
                ]);
            }
        }else {
            $post->postVideos()->delete();
        }
        $post->update([
            'title_ar'=>!empty($request['title_ar']) ? $request['title_ar'] : $post['titlear'],
            'title_en'=>!empty($request['title_en']) ?  $request['title_en'] : $post['title_en'],
            'cat_id'  =>!empty($request->cat_id) ? $request['cat_id'] : $post['cat_id'],
            'spare_id'=>!empty($request->spares) ? json_encode($request->spares) : $post['spare_id'],
            'brands_id'=> !empty($request->brands) ? json_encode($request->brands) : $post['brands_id'],
            'area_id'=>!empty($request->area_id) ? $request['area_id'] : $post['area_id'],
            'km' => !empty($request->km) ? $request['km'] : $post['km'],
            'price'=>!empty($request->price) ? $request['price'] : $post['price'],
            'price_type'=> $request->price_type!=null ? $request['price_type'] : $post['price_type'],
            'model'=>!empty($request->model) ? $request['model'] :  $post['model'],
            'use_status'=> !empty($request->use_status) ? $request['use_status'] : $post['use_status'],
            'post_type'=>!empty($request->post_type) ? $request['post_type'] : $post['post_type'],
            'fuel_type'=>!empty($request->fuel_type) ? $request['fuel_type'] : $post['fuel_type'],
            'bank_id'=>!empty($request->bank_id) ? $request['bank_id'] : $post['bank_id'],
            'gear_type'=>!empty($request->gear_type) ? $request['gear_type'] : $post['gear_type'],
            'double'=>!empty($request->double) ? $request['double'] : $post['double'],
            'description'=>!empty($request->description) ? $request['description'] : $post['description'],
            'mobile' => $mobile ,
            'lat'=> $lat ?? $post['lat']   ,
            'lng'=> $lang ?? $post['lng'],
            'contact'=>$contact ?? $post['contact'] ,
            'commission'=>$commission ?? $post['commission'],
            'Show_on_map' => $request['show_on_map'],


            'advertiser_status'=>$request->advertiser_status,
            'commercial_advertiser_number'=>$request->commercial_advertiser_number,
            'street_type'=>$request->street_type,
            'direction'=>$request->direction,
            'place'=>$request->place,
             'color'=>$request->color,
            'more_details'=>$request->more_details,
            
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
        return $this->sendMessageResponse(__('site.Post Updated'));
    }

    public function destroy($id){
        $post =  Post::find($id);
        if ($post->post_user->user->id != Auth::user()->id){
            return abort(403);
        }
        $post->forceDelete();
        return $this->sendMessageResponse(__('site.Post Deleted'));
    }

    public function toggleComments(Post $post){
        if (!($post->post_user->user->id == Auth::user()->id ) )
            return abort(403);

        $post->comment = 1 ? $post->comment = 0 : $post->comment = 1;
        $post->save();
        return $this->sendMessageResponse(__('site.comments toggled'));

    }

}
