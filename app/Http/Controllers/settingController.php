<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\HarajBank;
use App\Models\menues;
use App\Models\menues_items;
use App\Models\Cat;
use App\Models\transferDate;
class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings=setting::orderBy('sort')->get();
        return view('admin.setting.index',compact('settings'));
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
    public function update(Request $request)
    {
        //
        // dd($request);
        if($request->hasFile('logo')){
            $str=rand();
            $result = md5($str);
            $file =$request['logo'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $logo='setting/'.$file_name;
        }else{
            $sL=setting::where('name','logo')->first();
            $logo=$sL->value;
        }
        if($request->hasFile('favicon')){
            $str=rand();
            $result = md5($str);
            $file =$request['favicon'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $icon='setting/'.$file_name;
        }
        else{
            $s=setting::where('name','favicon')->first();
            $icon=$s->value;
        }
    $ss=setting::where('for','basic')->get();
    foreach($ss as $s){
        if($s->form_type!='file'){
            $name=$s->name;
            $s->update([
                'value'=>$request->{$name},
            ]);
        }else{
           if($s->name=='logo') {
            $s->update([
               'value'=>$logo,
            ]);
           }
           if($s->name=='favicon') {
            $s->update([
               'value'=>$icon,
            ]);
           }
        }
    }
    return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم التعديل',
        'text' => 'تم التعديل بنجاح'
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
    }
    // ================wm====================
    public function wm_index(){
        $settings=Setting::get();
        return view('admin.setting.watermark',compact('settings'));
    }
    public function vm_update(Request $request){
        if($request->hasFile('WM_img')){
            $str=rand();
            $result = md5($str);
            $file =$request['WM_img'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $icon='setting/'.$file_name;
        }
        else{
            $s=setting::where('name','WM_img')->first();
            $icon=$s->value;
        }
    $ss=setting::where('for','wm')->get();
    foreach($ss as $s){
        if($s->form_type!='file'){
            $name=$s->name;
            $s->update([
                'value'=>$request->{$name},
            ]);
        }else{
           if($s->name=='WM_img') {
            $s->update([
               'value'=>$icon,
            ]);
           }
        }
    }
    return  redirect()->back()->with(['alert' => [
        'icon' => 'success',
        'title' =>'تم التعديل',
        'text' => 'تم التعديل بنجاح'
    ]]);
}


    // ===================bank================
    public function bank(){
        $banks=HarajBank::get();
        return view('admin.setting.bank',compact('banks'));
    }
    public function addBank(Request $request){
        
        $qr = "";

        if($request->hasFile('logo')){
            $str=rand();
            $result = md5($str);
            $file =$request['logo'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $logo='setting/'.$file_name;
        }if($request->hasFile('qr')){
            $str=rand();
            $result = md5($str);
            $file =$request['qr'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $qr='setting/'.$file_name;
        }
        $bank=HarajBank::create([
            'bankName'=>$request['name'],
            'accountnumber'=>$request['account'],
            'userNameBank'=>$request['userBankName'],
            'Iban'=>$request['Iban'],
            'bank_photo'=>$logo,
            'qr'=>$qr,
        ]);
        return  redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تمت الاضافه',
            'text' => 'تم اضافة الحساب بنجاح'
        ]]);
    }
    public function updateBank($id,Request $request){
        $bank=HarajBank::find($id);
        if($request->hasFile('logo')){
            $str=rand();
            $result = md5($str);
            $file =$request['logo'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $logo='setting/'.$file_name;
        }else{
            $logo=$bank->bank_photo;
        }if($request->hasFile('qr')){
            $str=rand();
            $result = md5($str);
            $file =$request['qr'];
            $file_name = time() . $result . $file->getClientOriginalName();
            $file->move(base_path() . '/public/storage/setting/' , $file_name);
      $qr='setting/'.$file_name;
        }else{
            $qr=$bank->qr;
        }
        $bank->update([
            'bankName'=>$request['name'],
            'accountnumber'=>$request['account'],
            'userNameBank'=>$request['userBankName'],
            'Iban'=>$request['Iban'],
            'bank_photo'=>$logo,
            'qr'=>$qr,
        ]);
        return  redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم التعديل',
            'text' => 'تم تعديل الحساب بنجاح'
        ]]);
    }
    public function delBank($id){
        $bank=HarajBank::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الحذف ',
            'text' => 'تم حذف الحساب بنجاح'
        ]]);
    }

    public function filter_menue(){
        $menues=menues::get();
        return view('admin.setting.filter_menue',compact('menues'));
    }
    public function update_menue_filter(Request $request,$id){
        $menue=menues::find($id);
        $menue->update([
            'show'=>$request['show'],
            'is'=>$request['is'],
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم التعديل ',
            'text' => 'تم التعديل  بنجاح'
        ]]);
    }
    public function menues_item($id){
        $menue=menues::find($id);
        $items=menues_items::where('menues_id',$id)->get();
        return view('admin.setting.menue_items',compact('menue','items'));
    }
    public function add_menue_item(Request $request,$id){
        if(empty($request->name_ar)){
           $name_ar=Cat::find($request['cat'])->name_ar;
        }
        else{
            $name_ar=$request['name_ar'];
        }
        if(empty($request->name_en)){
            $name_en=$name_ar;
         }
         else{
             $name_en=$request['name_en'];
         }

           $item=menues_items::create([
               'cat_id'=>$request['cat'],
               'menues_id'=>$id,
               'show_name_ar'=>$name_ar,
               'show_name_en'=>$name_en,
               'is'=>$request['is'],
               'sort'=>$request['sort'],
               'img_filter'=>$request['img_filter'],

           ]);
           return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الاضافة  ',
            'text' => 'تم الأضافة  بنجاح'
        ]]);
    }
    public function del_item_menue($id){
        menues_items::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الحذف   ',
            'text' => 'تم الحذف  بنجاح'
        ]]);
    }
    public function update_menue_item(Request $request,$id){
        $item=menues_items::find($id);
        if(empty($request->name_en)){
            $name_en=$request['name_ar'];
         }
         else{
             $name_en=$request['name_en'];
         }

           $item->update([
               'show_name_ar'=>$request['name_ar'],
               'show_name_en'=>$name_en,
               'is'=>$request['is'],
               'sort'=>$request['sort'],
               'img_filter'=>$request['img_filter'],

           ]);
           return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم التعديل ',
            'text' => 'تم التعديل  بنجاح'
        ]]);
    }
    // ==============time transfer========================
    public function time_transfer(){
        $dates=transferDate::get();
        return view('admin.transfer.date',compact('dates'));
    }
    public function create_time_transfer(Request $request){
    if($request['name_en']){
        $name_en=$request['name_en'];
    }
    else{
        $name_en=$request['name_ar'];
    }
        transferDate::create([
            'name_ar'=>$request['name_ar'],
            'name_en'=>$name_en,
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الأضافه ',
            'text' => 'تم أضافه التوقيت  بنجاح'
        ]]);
    }
    public function destroy_time_transfer($id){
        transferDate::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>' تم الحذف ',
            'text' => 'تم حذف التوقيت  بنجاح'
        ]]);
    }
}
