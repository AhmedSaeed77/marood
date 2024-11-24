<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest;
use App\Http\Requests\StoreInquireComment;
use App\Http\Resources\InquiryResource;
use App\Http\Resources\PostResource;
use App\Models\Cat;
use App\Models\FavInquire;
use App\Models\followCat;
use App\Models\InquireComment;
use App\Models\Inquiry;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class InquiryController extends Controller
{


    use ApiTrait;

    public function store(InquiryRequest $request)
    {
        if($request->images == null && $request->details == null){

          return  response()->json(['message' => 'Validation failed', 'errors' => "يجب اضافه تفاصيل او صور"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data = $request->validated();

        $images = [];

        if ($request->hasfile('images')) {

        foreach ($request->file('images') as $image) {

            $name = time() . '.' . $image->getClientOriginalName();
            $image->move('inquiries/', $name);
            $images[] = 'inquiries/'.$name;
        }

         $data['images'] = json_encode($images);

        }

        $data['user_id'] = auth('api')->id();
        Inquiry::create($data);

        return $this->sendResponse('تم اضافه الاستفسار بنجاح',[],200);


    }

    public function show($id): JsonResponse
    {
        $inquire = Inquiry::query()->find($id);

        if(!$inquire){
            return $this->sendResponse('هذه الاستفسار غير موجوده',[],404);
        }

       return $this->sendResponse('تم عرض الاستفسار بنجاح',new InquiryResource($inquire),200);


    }



    public function update($id,InquiryRequest $request): JsonResponse
    {
        $inquire = Inquiry::query()->find($id);

        if(!$inquire){
            return $this->sendResponse('هذه الاستفسار غير موجوده',[],404);
        }


        if($request->images == null && $request->details == null){

            return  response()->json(['message' => 'Validation failed', 'errors' => "يجب اضافه تفاصيل او صور"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data = $request->validated();

        $images = [];

        if ($request->hasfile('images')) {

            foreach ($request->file('images') as $image) {

                $name = time() . '.' . $image->getClientOriginalName();
                $image->move('inquiries/', $name);
                $images[] = 'inquiries/'.$name;
            }

            $oldImages = json_decode($inquire->images, true);

            foreach ($oldImages as $oldImage) {
                if(file_exists($oldImage)){
                    unlink($oldImage);
                }
            }

            $data['images'] = json_encode($images);

        }

        $inquire->update($data);
        return $this->sendResponse('تم تعديل الاستفسار بنجاح',[],200);


    }


    public function getById($id): JsonResponse
    {
        if($id == 0){
            $inquires = Inquiry::query()
                ->get();

        }else{

            $category = Cat::query()->find($id);

            if(!$category){
                return $this->sendResponse('هذه الفئه غير موجوده',[],404);
            }

            $inquires = Inquiry::query()
                ->where('cat_id','=',$id)
                ->get();
        }

        return $this->sendResponse('تم الحصول علي جميع استفسارات هذه الفئه',InquiryResource::collection($inquires),200);
    }


    public function allByUser($id): JsonResponse
    {

        $user = User::query()->find($id);

        if(!$user){
            return $this->sendResponse('المستخدم غير موجوده',[],404);
        }

        $inquires = Inquiry::query()
            ->where('user_id','=',$id)
            ->get();

        return $this->sendResponse('تم الحصول علي جميع استفساراتك',InquiryResource::collection($inquires),200);
    }


    public function followCategory($id): JsonResponse
    {

        $category = Cat::query()->find($id);

        if(!$category){
            return $this->sendResponse('هذه الفئه غير موجوده',[],404);
        }

        $checkFollow = followCat::query()
            ->where('cat_id','=',$id)
            ->where('user_id','=',auth('api')->id())
            ->exists();
        if(!$checkFollow){

            followCat::create([
                'cat_id' => $id,
                'user_id' => auth('api')->id(),

            ]);
        }
        return $this->sendResponse('تم متابعه هذه الفئه',[],200);


    }


    public function unFollowCategory($id): JsonResponse
    {

        $category = Cat::query()->find($id);

        if(!$category){
            return $this->sendResponse('هذه الفئه غير موجوده',[],404);
        }

        $checkFollow = followCat::query()
            ->where('cat_id','=',$id)
            ->where('user_id','=',auth('api')->id())
            ->exists();

        if($checkFollow){
            followCat::query()->where('cat_id','=',$id)->delete();
        }
        return $this->sendResponse('تم الغاء متابعه هذه الفئه',[],200);


    }

    public function stories(): JsonResponse
    {
        $postsIds = Post::query()->get();

        $categories = followCat::query()
            ->where('user_id','=',auth('api')->id())
            ->pluck('cat_id')->toArray();

        $data = [];

        foreach ($postsIds as $post){

            if(in_array($post->cat_id,$categories)){
                $data[] = $post;
            }
        }

        return $this->sendResponse('success' , PostResource::collection($data));
    }

    public function delete($id): JsonResponse
    {
        $inquire = Inquiry::query()->find($id);

        if(!$inquire){
            return $this->sendResponse('هذه الاستفسار غير موجوده',[],404);
        }

        $inquire->delete();
        return $this->sendResponse('تم حذف الاستفسار بنجاح',[],200);

    }


    public function addComment(StoreInquireComment $request): JsonResponse
    {

        $data = $request->validated();

        $data['user_id'] = auth('api')->id();
        InquireComment::create($data);

        return $this->sendResponse('تم اضافه التعليق بنجاح',[],200);

    }


    public function addLove($id): JsonResponse
    {
        $inquire = Inquiry::query()->find($id);

        if(!$inquire){
            return $this->sendResponse('هذه الاستفسار غير موجوده',[],404);
        }


        $checkLove = FavInquire::query()
            ->where('inquire_id','=',$id)
            ->where('user_id','=',auth('api')->id())
            ->exists();

        if(!$checkLove){
            FavInquire::create([
                'inquire_id' => $id,
                'user_id' => auth('api')->id(),

            ]);
        }

        return $this->sendResponse('تم اضافه الاستفسار الي المفضله',[],200);

    }


    public function deleteLove($id): JsonResponse
    {
        $inquire = Inquiry::query()->find($id);

        if(!$inquire){
            return $this->sendResponse('هذه الاستفسار غير موجوده',[],404);
        }

        $checkLove = FavInquire::query()
            ->where('inquire_id','=',$id)
            ->where('user_id','=',auth('api')->id())
            ->exists();

        if($checkLove){
            FavInquire::query()->where('inquire_id','=',$id)->delete();
        }


        return $this->sendResponse('تم ازاله الاستفسار من المفضله',[],200);

    }


}
