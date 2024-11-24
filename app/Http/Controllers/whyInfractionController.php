<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infraction;
class whyInfractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $why=infraction::get();
        return view('admin.contact.whyInfraction',compact('why'));
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
        if(empty($request->title_en)){
            $request->title_en=$request->title_ar;
        }
        infraction::create([
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en
        ]);     
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الاضافه',
            'text' => 'تم اضافه سبب مخالفه بنجاح'
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
        $why=infraction::find($id);
        if(empty($request->title_en)){
            $request->title_en=$request->title_ar;
        }
        $why->update([
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en
        ]);     
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم التعديل',
            'text' => 'تم تعديل مخالفه بنجاح'
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
        infraction::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف مخالفه بنجاح'
        ]]);
    }
}
