<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
class areaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas=Area::get();
        return view('admin.area.index',compact('areas'));
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
        if($request->name_en==null){
            $name_en=$request->name_ar;
        }
        else{
            $name_en=$request->name_en;
        }
        $area=Area::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$name_en,
            'lat'=>$request->lat,
            'lng'=>$request->lng,
            'parent_id'=>$request->parent_id
        ]);
        return redirect()->back();
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
        $area=Area::find($id);
        if($request->name_en==null){
            $name_en=$request->name_ar;
        }
        else{
            $name_en=$request->name_en;
        }
        $area->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$name_en,
            'lat'=>$request->lat,
            'lng'=>$request->lng
        ]);
        return redirect()->back();
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
        Area::find($id)->delete();
        return redirect()->back();
    }


    // =====================city====================
    public function getCity(Request $request){
        $models = Area::where('parent_id' ,$request->area_id)->get();
    	return response()->json($models);
    }

    public function city_show($id){
        $country=Area::find($id);
        $areas=Area::where('parent_id',$id)->get();
        return view('admin.area.city',compact('areas','country'));
    }
}
