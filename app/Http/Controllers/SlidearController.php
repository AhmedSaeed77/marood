<?php

namespace App\Http\Controllers;

use App\Models\Slidear;
use Illuminate\Http\Request;
use Alert;
use Validator;
class SlidearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slidear=Slidear::get();
        return view('admin.slidear.index',compact('slidear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
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
            'photo'=>'mimes:jpeg,jpg,png,gif'
                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
               
                if($request->hasFile('photo')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['photo'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/slidear/' , $file_name);
              $photo='public/storage/slidear/'.$file_name;
                }
    

                $cat=Slidear::create([
                    'image'=>$photo,
                    'url'=>$request['url']??'#',
                ]);
             
                return redirect()->back()->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم الاضافه',
                    'text' => 'تم اضافه البنر بنجاح'
                ]]);
    
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slidear $slidear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Slidear $slidear)
    {
        //
        $this->validate(request(), [
            'photo'=>'mimes:jpeg,jpg,png,gif'
                ]);
               
                if($request->hasFile('photo')){
                    $str=rand();
                    $result = md5($str);
                    $file =$request['photo'];
                    $file_name = time() . $result . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/storage/slidear/' , $file_name);
              $photo='public/storage/slidear/'.$file_name;
              $slidear->update([
                    'image'=>$photo,
                    ]);
                }
                $slidear->update([
                    'url'=>$request['url']??'#',
                ]);
               
                return redirect()->back()->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم التعديل',
                    'text' => 'تم تعديل البنر بنجاح'
                ]]);;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slidear  $slidear
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slidear $slidear)
    {
        //
        $slidear->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف البنر بنجاح'
        ]]);
    }
}
