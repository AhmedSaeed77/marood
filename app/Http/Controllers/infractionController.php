<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infraction;
use App\Models\postInfraction;
use Auth;
class infractionController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       //
       $why=infraction::get();
       $contact=postInfraction::get();
       return view('admin.contact.infraction',compact('why','contact'));
   }
 public function show_infraction($id){
    
        $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
        $why=infraction::get();
       $contact=postInfraction::get();
       $inf=postInfraction::find($noty->data['infraction_id']);
       $whyActive=$inf->type_id;
       return view('admin.contact.infraction',compact('why','contact','whyActive'));
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
       postInfraction::find($id)->delete();
       return redirect()->back()->with(['alert' => [
           'icon' => 'success',
           'title' =>'تم الحذف',
           'text' => 'تم حذف الرساله بنجاح'
       ]]);
   }
}
