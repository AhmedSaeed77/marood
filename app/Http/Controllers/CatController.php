<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Alert;
use Validator;
class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cats=Cat::get();
        return view('admin.cats.index',compact('cats'));
    }
    public function show_child($id){
      $cats=Cat::where('parent_id',$id)->get();
      $cat=Cat::where('id',$id)->first();
      $allcat=Cat::get();
      return view('admin.cats.child',compact('cats','cat','allcat'));
    }
    public function getSubCat(Request $request){
           $subCat=Cat::where('parent_id',$request->cat_id)->get();
           return response()->json($subCat);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parents=Cat::get();
        return view('admin.cats.create',compact('parents'));
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
    // dd($request);
        $rules= [
            'name_ar'    => 'required',
            'photo'=> 'mimes:jpeg,jpg,png,gif'
                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
                if(!empty($request->name_en)){
                    $name_en=$request->name_en;
                }
                else{
                    $name_en=$request->name_ar;
                }
                if($request->hasFile('photo')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['photo'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/cats/' , $file_name);
              $photo='cats/'.$file_name;
                }else{
                    $photo=null;
                }

//        return $request->for_parent_id;

                if($request->for_parent_id==1)
                {
                         $parentt=$request->parent_id;
                         $parent=Cat::find($request->parent_id);
                                  if($parent->parent_id != null){
                        while(!empty($parent->parent)){
                           $parent=$parent->parent;
                           }

                       }
                    $type=$parent->type;
                    $is_year=$parent->is_year;
                }else{$parentt=null;$type=$request['type'];$is_year=$request['is_year'];}
                
                 $cat_id = $request->for_parent_id == 'yes' ?  Cat::find($request->parent_id)->id : null;
                 
                $cat=Cat::create([
                    'name_ar'=>$request['name_ar'],
                    'name_en'=>$name_en,
                    'photo'=>$photo,
                    'icon'=>$request['icon'],
                    'show'=>$request['show'],
                    'sort'=>$request['sort'],
                    'parent_id'=>$cat_id,
                    'type'=>$type,
                    'is_year'=>$is_year,
                     'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description
                ]);

                return redirect()->route('cat_index')->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم الاضافه',
                    'text' => 'تم اضافه القسم بنجاح'
                ]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat,$id)
    {
        //
        $parents=Cat::where('parent_id',null)->get();
        $cat=Cat::where('id',$id)->first();
        return view('admin.cats.edit',compact('cat','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat,$id)
    {
        //
        $this->validate(request(), [
            'name_ar'    => 'required',
            'photo'=> 'mimes:jpeg,jpg,png,gif'
                ]);
                $cat=Cat::where('id',$id)->first();
                if(!empty($request->name_en)){
                    $name_en=$request->name_en;
                }
                else{
                    $name_en=$request->name_ar;
                }
                if($request->hasFile('photo')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['photo'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/cats/' , $file_name);
              $photo='cats/'.$file_name;
                }else{
                    $photo=$cat->photo;
                }

                         $parent=$cat->parent_id;

                $cat->update([
                    'name_ar'=>$request['name_ar'],
                    'name_en'=>$name_en,
                    'photo'=>$photo,
                    'icon'=>$request['icon'],
                    'show'=>$request['show'],
                    'sort'=>$request['sort'],
                    'is_year'=>$request['is_year'],
                    'type'=>$request['type'],
                    'parent_id'=>$parent,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description

                ]);

                return redirect()->route('cat_index')->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم التعديل',
                    'text' => 'تم تعديل القسم بنجاح'
                ]]);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat,$id)
    {
        //
        $cat=Cat::where('id',$id)->first()->delete();
       ;
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف القسم بنجاح'
        ]]);
    }
}
