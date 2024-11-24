<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyContact;
use App\Models\Contact;
use Auth;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $why=WhyContact::get();
        $contact=Contact::get();
        return view('admin.contact.index',compact('why','contact'));
    }
    public function show_contact($id){
           $why=WhyContact::get();
        $contact=Contact::get();
        $noty=Auth::user()->notifications->where('id',$id)->first();
        $noty->markAsRead();
        
        return view('admin.contact.index',compact('why','contact'));
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
        Contact::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف الرساله بنجاح'
        ]]);
    }
}
