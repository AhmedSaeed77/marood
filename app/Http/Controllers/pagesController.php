<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\footerPages;
use App\Models\questionForPages;
use Validator;
class pagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages=footerPages::get();
        return view('admin.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.create');
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
            'link'=>'required'
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


                $page=footerPages::create([
                    'name_ar'=>$request['name_ar'],
                    'name_en'=>$name_en,
                    'icon'=>$request->icon,
                    'link'=>$request['link'],
                    'content'=>$request['content'],
                      'content_en'=>$request['content_en'],
                    'active'=>$request['show']
                ]);
                return redirect()->route('pages.index')->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم الاضافة',
                    'text' => 'تم اضافة الصفحه بنجاح'
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
        $page=footerPages::find($id);
        return view('admin.pages.update',compact('page'));
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
        $rules= [
            'name_ar'    => 'required',
                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails()) {
                    return  redirect()->back()->withErrors($validate)
                        ->withInput();
                  }
                if(!empty($request->name_en)){
                    $name_en=$request->name_en;
                }
                else{
                    $name_en=$request->name_ar;
                }
       $page=footerPages::find($id);

                $page->update([
                    'name_ar'=>$request['name_ar'],
                    'name_en'=>$name_en,
                    'icon'=>$request->icon,
                    'link'=>$request['link'],
                    'content'=>$request['content'],
                     'content_en'=>$request['content_en'],
                    'active'=>$request['show']
                ]);

                return redirect()->route('pages.index')->with(['alert' => [
                    'icon' => 'success',
                    'title' =>'تم التعديل',
                    'text' => 'تم تعديل الصفحه بنجاح'
                ]]);
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
        footerPages::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف الصفحه بنجاح'
        ]]);;
    }
    // =================questions============
    public function questions($id){
        $questions=questionForPages::where('page_id',$id)->get();
        $page=footerPages::find($id);
        return view('admin.pages.questions',compact('questions','page'));
    }
    public function del_question($id){
        questionForPages::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم  حذف السؤال بنجاح'
        ]]);
    }
    public function add_question(Request $request,$id){
$q=questionForPages::create([
    'question'=>$request['question'],
    'answer'=>$request['answer'],
    'parent_id'=>$request['parent_id'],
    'page_id'=>$id
]);
return redirect()->back()->with(['alert' => [
    'icon' => 'success',
    'title' =>'تمت الاضافه',
    'text' => 'تم اضافه السؤال بنجاح'
]]);
    }
    public function edit_question(Request $request,$id){
        $q=questionForPages::find($id);
        $q->update([
            'question'=>$request['question'],
            'answer'=>$request['answer'],
            'parent_id'=>$request['parent_id'],
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم التعديل',
            'text' => 'تم تعديل السؤال بنجاح'
        ]]);
            }
}
