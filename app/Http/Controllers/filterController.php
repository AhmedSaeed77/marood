<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Post;
use App\Models\Area;
use App\Models\sessionCat;
use App\Models\setting;
use App\Models\Slidear;

class filterController extends Controller
{

    public function search(Request $request){
           if(is_numeric($request['search'])){
            $posts=Post::find($request['search']);
            if($posts){
                return redirect()->route('single_post',$posts->id);
            }
        }
        $cats=Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get();
        
        $posts=Post::query()
            ->where('title_ar','like','%'.$request['search'].'%')
            ->orWhere('title_en','like','%'.$request['search'].'%')
            ->orWhereHas('area', function ($query) use ($request) {
                if(app()->getLocale() == 'ar'){
                    $query->where('name_ar','like','%'.$request['search'].'%');
                }else{
                    $query->where('name_en','like','%'.$request['search'].'%');
                }
            })
            ->where('active',1)
            ->orderby('special_id')
            ->paginate(25);
     
        $areas=Area::get();
        $setting =setting::get();
        $slidear=Slidear::get();
        return view('site.index',compact('cats','posts','areas','setting','slidear'));
    }


    public function mainFilter(Request $request)
    {
        if(session()->has('sessionCat'))
        {
            $sessionCat = new sessionCat(session()->get('sessionCat'));
        }
        else
        {
            $sessionCat = new sessionCat();
        }
                $areas=Area::where('id',$request['area_id'])->orWhere('parent_id',$request['area_id'])->pluck('id')->toArray();
                $area=Area::find($request['area_id']);
        $cat= Cat::find($request->cat_id);
        $sessionCat->add($cat);
        session()->put('sessionCat' , $sessionCat);
        $parent=[];

            $child=Cat::where('parent_id',$request->cat_id)->pluck('id')->toArray();
            $parent=array_merge($parent,$child);
            if(!empty($child)){
            while (!empty($child)) {
                $child=Cat::whereIn('parent_id',$child)->pluck('id')->toArray();
                $parent=array_merge($parent,$child);
            }
            }else{
                $parent=[$request->cat_id];
            }
            if(isset($request['area_id']) && $request['area_id'] !='*'){

        $posts=Post::whereIn('cat_id',$parent)->whereIn('area_id',$areas)->where('active',1)->paginate(25);
            }else{
            $parent[] = $cat->id;

             $posts=Post::whereIn('cat_id',$parent)->where('active',1)->paginate(25);
            }
            $setting =setting::get();
        return view('site.postFilter',compact('posts','area','setting'));

    }

public function get_post_area(Request $request){

    foreach($request['cat_ids'] as $ca){
        if(is_numeric($ca)){
          $catt=$ca;
        }
    }
        $areas=Area::where('id',$request['area_id'])->orWhere('parent_id',$request['area_id'])->pluck('id')->toArray();
                $area=Area::find($request['area_id']);

    if(isset($catt) ){
  $cat= Cat::find($catt);
        $parent=[];
            $child=Cat::where('parent_id',$request->cat_id)->pluck('id')->toArray();
            $parent=array_merge($parent,$child);
            if(!empty($child)){
            while (!empty($child)) {
                $child=Cat::whereIn('parent_id',$child)->pluck('id')->toArray();
                $parent=array_merge($parent,$child);
            }
            }else{
                $parent=[$request->cat_id];
            }
   $posts=Post::whereIn('cat_id',$parent)->whereIn('area_id',$areas)->where('active',1)->get();
    }elseif(isset($request['area_id']) && $request['area_id'] != '*'){
       $posts=Post::whereIn('area_id',$areas)->where('active',1)->get();
    }else{
        $posts=Post::get();
    }
    $setting =setting::get();
        return view('site.postFilter',compact('posts','area','setting'));
}

   public function get_parentcat(Request $request){
       $cat=Cat::find($request->id);
       $parent=Cat::find($cat->parent_id);
       return response()->json($parent);
   }



   public function city_ajax(Request $request){
      $areas=Area::where('parent_id',182)->take(5)->get();
      $cat=Cat::find($request->cat_id);
      $x= $areas;
      $y=$cat;
       $m=[$x,$y];
      return response()->json($m) ;
   }




   public function city_search($id){
    $cats=Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get();
        $areas=Area::where('id',$id)->orWhere('parent_id',$id)->pluck('id')->toArray();
                $area=Area::find($id);

    $posts=Post::where('active',1)->whereIn('area_id',$areas)->orderby('special_id')->paginate(25);
    $areas=Area::get();
    $areaSelect=Area::find($id);
    $setting =setting::get();
    $slidear=Slidear::get();
    return view('site.index',compact('cats','posts','areas','areaSelect','setting','slidear','area'));
   }


 public function city_category_search($id,$cat_id){
        $cats=Cat::where('parent_id',null)->where('show',1)->orderBy('sort')->get();
        $areas=Area::where('id',$id)->orWhere('parent_id',$id)->pluck('id')->toArray();
        $area=Area::find($id);

        $posts=Post::where('active',1)->where('cat_id',$cat_id)->whereIn('area_id',$areas)->orderby('special_id')->paginate(25);
        $areas=Area::get();
        $areaSelect=Area::find($id);
        $setting =setting::get();
        $slidear=Slidear::get();
        return view('site.index',compact('cats','posts','areas','areaSelect','setting','slidear','area'));
    }


   public function city_cat_search($city_id,$cat_id){
    $setting =setting::get();
       $areas=Area::get();
       $cats=Cat::get();
           $areas=Area::where('id',$city_id)->orWhere('parent_id',$city_id)->pluck('id')->toArray();
                $area=Area::find($city_id);

       $posts=Post::whereIn('area_id',$areas)->get();
       $parent=[];
       $child=Cat::where('parent_id',$cat_id)->pluck('id')->toArray();
       $catt=Cat::find($cat_id);
       $parent=array_merge($parent,$child);
       if(!empty($child)){
       while (!empty($child)) {
           $child=Cat::whereIn('parent_id',$child)->pluck('id')->toArray();
           $parent=array_merge($parent,$child);
         }
       }else{
           $parent=[$cat_id];
       }
    $posts=$posts->whereIn('cat_id',$parent)->where('active',1);
    $mainCat=$catt;$areaSelect=Area::find($city_id);
            $slidear=Slidear::get();
            $areas=Area::get();
    return view('site.index',compact('areas','posts','cats','mainCat','areaSelect','setting','slidear','area'));


   }
   public function get_subcat(Request $request){
    if(session()->has('sessionCat'))
    {
        $sessionCat = new sessionCat(session()->get('sessionCat'));
    }
    else
    {
        $sessionCat = new sessionCat();
    }
    $cat= Cat::find($request->id);
    $sessionCat->add($cat);
    session()->put('sessionCat' , $sessionCat);
       $cats=Cat::where('parent_id',$request['id'])->where('show',1)->get();
       return response()->json($cats);
   }

   public function get_main_cat(Request $request){

    $cats= Cat::where('parent_id',NULL)->get();
    return response()->json($cats);
   }


   public function get_cat_year(Request $request){
    if(session()->has('sessionCat'))
    {
        $sessionCat = new sessionCat(session()->get('sessionCat'));
    }
    else
    {
        $sessionCat = new sessionCat();
    }
    $cat= Cat::find($request->id);
    $sessionCat->add($cat);
    session()->put('sessionCat' , $sessionCat);
       return response()->json($cat);
   }

public function get_session_ajax(){
    return session('sessionCat')->items;
}





   public function mainF($id)
   {
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
    $parent=[];
    $areas=Area::get();
    $cats=Cat::where('show',1)->get();

    $child=Cat::where('parent_id',$id)->pluck('id')->toArray();
    $parent=array_merge($parent,$child);
    $cat=Cat::find($id);

    if(!empty($child)){
    while (!empty($child)) {
        $child=Cat::whereIn('parent_id',$child)->pluck('id')->toArray();
        $parent=array_merge($parent,$child);
      }
    }else{

        $parent=[$cat->id];

    }
   $posts=Post::whereIn('cat_id',$parent)->where('active',1)->paginate(25);
   if($cat->parent_id==null){
    $mainCat=$cat;
   }else{
       $mainCat=Cat::find($cat->parent_id);
   }
      $setting=setting::get();
       $slidear=Slidear::get();
   return view('site.index',compact('areas','posts','cats','mainCat','setting','slidear'));
   }

   public function tagFilterOnlyNew(){

       $posts=Post::orderBy('created_at','desc')->where('active',1)->paginate(25);
       $setting =setting::get();
           return view('site.postFilter',compact('posts','setting'));
   }

    public function tagFilterOnlyDiesel(){

        $posts=Post::where('fuel_type',2)->where('active',1)->paginate(25);
        $setting =setting::get();
        return view('site.postFilter',compact('posts','setting'));
    }

    public function tagFilterOnlyConcession(){

        $posts=Post::where('post_type',2)->where('active',1)->paginate(25);
        $setting =setting::get();
        return view('site.postFilter',compact('posts','setting'));
    }

    public function tagFilterOnlyScraping(){

        $posts=Post::where('use_status',3)->where('active',1)->paginate(25);
        $setting =setting::get();
        return view('site.postFilter',compact('posts','setting'));
    }

     public function get_cat(Request $request){

       $cat=Cat::find($request['id']);
       $model=setting::where('name','modelNumber')->first()->value;
       $year=date('Y');
       $array=[$cat,$model,$year+1];
       return response()->json($array);
   }
   public function search_with_modal(Request $request){
       $posts=Post::where('cat_id',$request['id'])->where('model',$request['model'])->where('active',1)->paginate(25);
       $setting =setting::get();
       return view('site.postFilter',compact('posts','setting'));
   }

   public function get_area_children(Request $request){
       $area=Area::find($request['area_id']);
       $areas=$area->children;
       $count=$area->children->count();
         $children=[];
         foreach($areas as $area){
            array_push($children,['name'=>$area->name,'id'=>$area->id]);
         }
       $m=[$area,$children,$count];
       return $m;
   }


   public function filterByCreatedAt(Request $request){

      $posts=Post::whereYear('created_at','>=',$request->from)->whereYear('created_at','>=',$request->from)->paginate(25);
       $setting =setting::get();
       return view('site.postFilter',compact('posts','setting'));
   }
}
