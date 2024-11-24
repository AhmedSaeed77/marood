<?php

namespace App\Http\Controllers\Api;

use App\Customs\FilterServices;
use App\Http\Controllers\Controller\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\MenueResource;
use App\Http\Resources\PostCollection;
use App\Models\menues_items;
use App\Models\Rate;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Models\footerPages;
use App\Http\Resources\CategoryResource;
use App\Models\Cat;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Resources\BankResource;
use App\Models\HarajBank;
use App\Models\Contact;
use App\Http\Resources\WhyContactResource;
use App\Models\WhyContact;
use App\Notifications\contactNotfication;
use App\Models\User;
use Tymon\JWTAuth\JWTAuth;
use App\Models\setting;


class SiteController extends BaseController
{
    use ApiTrait;
    use HelperTrait;
    
     #################### Start Filter all posts ##########################
    public function posts(){

        $query = Post::query();

          $query->when(request()->has('search') && request('search') != null, function ($q)  {
            $q->where(function ($query){
                $query->where('title_ar', 'LIKE', '%'.request()->input('search').'%')
                    ->orWhere('title_en' , 'LIKE' , '%'.request('search').'%')
                    ->orWhere('description' , 'LIKE' , '%'.request('search').'%');
            });
        });



        
        $query->when(request()->has('category') && request('category') != null, function ($q)  {
           $categoryId = request()->input('category');

       // Get all descendants including the category itself
         $allCategoryIds =  $this->getAllDescendants($categoryId, [$categoryId]);

       if(count($allCategoryIds) > 0){
        $q->whereIn('cat_id', $allCategoryIds);
        }
         });

        $query->when(request()->has('image') && request('image') != null, function ($q)  {
            if(request('image') == 1){
                $q->whereHas('images');
            }elseif (request('image') == 0){

                $q->whereDoesntHave('images');
            }else{

                $q->whereHas('images');
            }
        });
        
         $query->when(request()->has('model') && request('model') != null, function ($q)  {
                $q->where('model','=',request()->input('model'));
        });


       $query->when(request()->has('order') && request('order') != null, function ($q)  {
            if(request('order') == 'desc'){
                $q->orderBy('created_at','desc');
            }elseif (request('order') == 'asc'){
                $q->orderBy('created_at','asc');
            }else{
                $q->orderBy('created_at','desc');
            }
        });

       
       $query->when(request()->has('area') && request('area')[0] != "", function ($q) {
            $areas = request('area');
            $areaIds = [];

            foreach ($areas as $areaId) {
                $areaModel = Area::find($areaId);

                if ($areaModel) {
                    $areaIds[] = $areaModel->id;

                    // Get all child areas recursively
                    $childAreas = $this->getAllChildAreas($areaModel->id);
                    $areaIds = array_merge($areaIds, $childAreas);
                }
            }

            $q->whereIn('area_id', $areaIds);
        });

        if(request('perpage') == null){
            
          $perPage = 10;  
        }else{
            
            $perPage = (int)request()->input('perpage');
        }


        $posts = $query
            ->where('active',1)
            ->paginate($perPage);

        $posts =  new PostCollection($posts);
        return $this->sendResponse('success' , ($posts));
    }
    
    protected function getAllChildAreas($parentId)
    {
        $childAreas = Area::where('parent_id', $parentId)->pluck('id')->toArray();
        $allChildAreas = $childAreas;

        foreach ($childAreas as $childId) {
            $grandChildAreas = $this->getAllChildAreas($childId);
            $allChildAreas = array_merge($allChildAreas, $grandChildAreas);
        }

        return $allChildAreas;
    }
    
   public function getAllDescendants($categoryId, $categories = []) {
    $children = Cat::where('parent_id', $categoryId)->get();

    foreach ($children as $child) {
        $categories[] = $child->id;
        $categories = $this->getAllDescendants($child->id, $categories);
    }

    return $categories;
    }
    #################### Start Filter all posts ##########################


    // public function posts(){

    //     $posts = Post::query();
    //     $perPage = request('perpage') ?? 10;

    //     $posts->filter();

    //     $posts =  new PostCollection($posts->paginate($perPage));
    //     return $this->sendResponse('success' , ($posts));

    // }
    // public function search(Request $request){
    //       $posts= Post::where('title_ar','LIKE','%'.$request->word.'%')
    //           ->orwhere('title_en','LIKE','%'.$request->word.'%')
    //           ->orwhere('description','LIKE','%'.$request->word.'%')->paginate(10);
    //     $posts =  new PostCollection($posts);
    //     return $this->sendResponse('success' , ($posts));
    // }
    
    



    public  function userRate(Request $request){
        if(User::find(auth()->user()->id)->alreadyRate($request->user_id)){
            return $this->sendResponse('success' , (__('Rate Already Exists')));
        }else {
                    if($request->user_id==auth()->user()->id){
            return $this->sendResponse('success' , (__('cannot rate your self')));
        }else{
            Rate::create([
                'user_id'=>$request->user_id,
                'rater_id'=>auth()->user()->id,
                'rate'=>$request->rate,
            ]);
            return $this->sendResponse('success' , (__('added successfully')));
        }
        }
    }
    public  function getRate($id){
            $rates=Rate::where('user_id',$id)->avg('rate');
//            $average=round($rates)>5?5:round($rates);
            $average=$rates>5?5:$rates;
        return response()->json([
            'status'=>true,
            'message' => 'success',
            'rate' =>$average
        ], 201);    }
    public function postDetails($id){
        $post = Post::find($id);
        $post->lastPost=Post::where('id','<',$id)->orderby('id','DESC')->first()->id??null;
        $post->nextPost=Post::where('id','>',$id)->first()->id??null;
        if($post){
        return $this->sendResponse('success' , PostResource::make($post));
        }
    }
    public function page($id){
        $page= PageResource::collection(footerPages::where('id',$id)->get());
        return response()->json([
            'status'=>true,
            'message' => 'success',
            'data' =>$page,
        ], 201);    }
    //=======================pages=============

    public function pages(){
        $pages= PageResource::collection(footerPages::all());
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$pages,
            ], 201);
    }
    // ========================cats==============
    public function cats(){
//        $cats= CategoryResource::collection(Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get());
//        return response()->json([
//            'status'=>true,
//                'message' => 'success',
//                'data' =>$cats
//            ], 201);
        $menues = menues_items::where('menues_id',2)->orderBy('sort')->get();
        return response()->json([
            'status'=>true,
            'message' => 'success',
            'data' =>MenueResource::collection($menues)
        ], 201);
    }
    public function catsAdd(){
        $menues=menues_items::where('menues_id',4)->get();
        return response()->json([
            'status'=>true,
            'message' => 'success',
            'data' =>MenueResource::collection($menues)
        ], 201);
    }
    public function category_child($id){
        $cat=Cat::find($id);
        if($cat){
        $cats= CategoryResource::collection($cat->child);
        return $this->sendResponse('success' , $cats);
        }else{
            return $this->sendMessageResponse('No Category Found');
        }
    }
    // =========================areas==========
    public function areas(){
        $areas= AreaResource::collection(Area::where('parent_id',null)->get());
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$areas
            ], 201);
        
        
       
    }

    public function area_child($id){
        $area=Area::find($id);
        if($area){
        $areas= AreaResource::collection($area->child);
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$areas
            ], 201);
        }else{
            return response()->json([
                'status'=>false,
                    'message' => __('site.check area id'),
                    'data' =>false,
                ], 401);
        }
    }

      //=======================pages=============

      public function banks(){
        $banks= BankResource::collection(HarajBank::all());
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$banks,
            ], 201);
    }

    // ====================contact===============
    public function contact_why(){
        $why= WhyContactResource::collection(WhyContact::all());
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$why,
            ], 201);
    }
    public function contact(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
//            'phone'=>'required|unique:users,phone|max:11',
            'description'=> 'required',
            'photo'=> 'nullable|Image',
            'why'=>'required|exists:why_contacts,id'
          ]);
          if($validator->fails())
          {
              $errorarr = array();
              return $this->sendError($errorarr, $validator->errors([0]));
          }
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
    'why_id'=>$request['why'],
    'desc'=>$request['description'],
    'email'=>$request['email'],
    'photo'=>$photo,
//    'phone'=>$request['phone'],
    ]);
    $users=User::get();
    foreach($users as $user){
              if($user->hasAnyRole('admin', 'superAdmin')){
    $user->notify(new contactNotfication($contact,'تم ارسال رساله اتصال جديده'));
        }
    }
    return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$contact,
        ], 201);

    }
    private function preparePush() {
        $notification =[
            'registration_ids' => ['epuB0FdrSnSACyYwnWFfzj:APA91bGI3fwEf4ajdqgUeqYAVku-PLkZmqCg0hCwEnGDYMA3tm1IejbOWhQgIlE1gMpWXla2XPgYDk63JsppMqqRApPteFo6CWDUPWn3CTvJ2QuksGGVPLur5QSnShrGkdMjxCJm7ILQ'],
            'notification' => [
                'title' => 'heda',
                'body' => 'vsnadklvnlsadvnsdvsd',
            ],
            'data' => [
                'post_id ' =>'50'
            ],
        ];
        return json_encode($notification);
    }
    public function sendNotification(){
        try {
            $notification = $this->preparePush();
            $headers = [
                'Authorization: key=' . 'AAAAX44JpBQ:APA91bEqOdVtGqE0s7MFxNeGZU7pCMkez6FjLbN1-BdrfW_iJ0yab7hW_-I6RfO8jV7O6Au4qZQcGZCLx08ViWUdpUzPA0bXfqjvH87FIGrB55NVY-Zdjj6qcvgKY9J-b0LBhEOSI6R2',
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

}
