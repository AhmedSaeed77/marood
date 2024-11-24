<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberShip;
use App\Models\commissionMember;
use App\Models\questionForPages;
use App\Models\MembershipPackage;
use App\Models\CommessionTransfer;
use App\Models\User;
use Validator;
class membershipController extends Controller
{
    //
    public function index(){
        $members=MemberShip::get();
        return view('admin.member.index',compact('members'));
    }
    public function create(){
        return view('admin.member.create');
    }
    public function store(Request $request){
        // dd($request);
        $request->validate( [
            'title_ar'    => 'required',
            'desc_ar'    => 'required',
            'adv_ar'    => 'required',

            
                ]);
           
              
                   if(empty($request->title_en)){
                       $request->title_en =$request->title_ar;
                   }
                   if(empty($request->desc_en)){
                    $request->desc_en =$request->desc_ar;
                    }
                    if(empty($request->adv_en)){
                        $request->adv_en =$request->adv_ar;
                    }
                    if(empty($request->cond_en)){
                        $request->cond_en =$request->cond_ar;
                    }
                    MemberShip::create([
                        'title_ar'=>$request->title_ar,
                        'title_en'=>$request->title_en,
                        'desc_ar'=>$request->desc_ar,
                        'desc_en'=>$request->desc_en,
                        'advantage_ar'=>$request->adv_ar,
                        'advantage_en'=>$request->adv_en,
                        'condition_ar'=>$request->cond_ar,
                        'condition_en'=>$request->cond_en
                    ]);
                    return redirect()->route('memberShip.index')->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم الاضافه',
                        'text' => 'تم اضافه العضوية بنجاح'
                    ]]);
              
    }
    public function destroy($id){
        MemberShip::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم حذف العضوية بنجاح'
        ]]);
    }
    public function edit(Request $request,$id){
        $member=MemberShip::find($id);
        return view('admin.member.edit',compact('member'));
    }
    public function update(Request $request,$id){
        $request->validate( [
            'title_ar'    => 'required',
            'desc_ar'    => 'required',
            'adv_ar'    => 'required',

            
                ]);
           
              
                   if(empty($request->title_en)){
                       $request->title_en =$request->title_ar;
                   }
                   if(empty($request->desc_en)){
                    $request->desc_en =$request->desc_ar;
                    }
                    if(empty($request->adv_en)){
                        $request->adv_en =$request->adv_ar;
                    }
                    if(empty($request->cond_en)){
                        $request->cond_en =$request->cond_ar;
                    }
                    $member=MemberShip::find($id);
                    $member->update([
                        'title_ar'=>$request->title_ar,
                        'title_en'=>$request->title_en,
                        'desc_ar'=>$request->desc_ar,
                        'desc_en'=>$request->desc_en,
                        'advantage_ar'=>$request->adv_ar,
                        'advantage_en'=>$request->adv_en,
                        'condition_ar'=>$request->cond_ar,
                        'condition_en'=>$request->cond_en
                    ]);
                    return redirect()->route('memberShip.index')->with(['alert' => [
                        'icon' => 'success',
                        'title' =>'تم التعديل',
                        'text' => 'تم تعديل العضوية بنجاح'
                    ]]);
    }
     //    ===========subscripe price =============
     public function memberSubscripe($id){
            $member=MemberShip::find($id);
            return view('admin.member.subscripe',compact('member'));
     }
     public function package_destroy($id){
        MembershipPackage::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم  حذف العرض بنجاح'
        ]]);
     }
     public function package_create(Request $request,$id){
         if($request['title_en']){
             $title_en=$request['title_en'];
         }else{
             $title_en=$request['title_ar'];
         }
        MembershipPackage::create([
            'title_ar'=>$request['title_ar'],
            'title_en'=>$title_en,
            'number'=>$request['number'],
            'duration'=>$request['duration'],
           'price'=>$request['price'],
            'member_id'=>$id,
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الاضافه',
            'text' => 'تم  اضافة العرض بنجاح'
        ]]);
     }
     public function package_update(Request $request,$id){
         $package=MembershipPackage::find($id);
        if($request['title_en']){
            $title_en=$request['title_en'];
        }else{
            $title_en=$request['title_ar'];
        }
       $package->update([
           'title_ar'=>$request['title_ar'],
           'title_en'=>$title_en,
           'number'=>$request['number'],
           'price'=>$request['price'],
           'duration'=>$request['duration'],
       ]);
       return redirect()->back()->with(['alert' => [
           'icon' => 'success',
           'title' =>'تم الاضافه',
           'text' => 'تم  اضافة العرض بنجاح'
       ]]);
    }
    //======== question for member==================
    public function question($id){
        $questions=questionForPages::where('member_id',$id)->get();
        $member=MemberShip::find($id);
        return view('admin.member.questions',compact('questions','member'));
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
    'member_id'=>$id
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
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم التعديل',
            'text' => 'تم تعديل السؤال بنجاح'
        ]]);
            }
    // ===================commession ===============
    public function commession_index(){
        $commissions =commissionMember::get();
        return view('admin.commission.index',compact('commissions'));
    }
    public function commession_destroy($id){
        $commissions =commissionMember::find($id)->delete();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الحذف',
            'text' => 'تم الحذف بنجاح'
        ]]);

    }
    public function commission_create(Request $request){
      if(empty($request['desc_en'])){
          $desc_en=$request['desc_ar'];
      }else{
        $desc_en=$request['desc_en'];

      }
      if(empty($request['name_en'])){
        $name_en=$request['name_ar'];
            }else{
            $name_en=$request['name_en'];

            }
        commissionMember::create([
            'cat_id'=>$request['cat'],
            'desc_ar'=>$request['desc_ar'],
            'desc_en'=>$desc_en,
            'name_ar'=>$request['name_ar'],
            'name_en'=>$name_en,
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' =>'تم الاضافة',
            'text' => 'تم الاضافة بنجاح'
        ]]);
    }
    public function commission_update(Request $request,$id){
        if(empty($request['desc_en'])){
            $desc_en=$request['desc_ar'];
        }else{
          $desc_en=$request['desc_en'];
  
        }
        if(empty($request['name_en'])){
          $name_en=$request['name_ar'];
      }else{
        $name_en=$request['name_en'];
  
      }
      $com=commissionMember::find($id);
          $com->update([
              'cat_id'=>$request['cat'],
              'desc_ar'=>$request['desc_ar'],
              'desc_en'=>$desc_en,
              'name_ar'=>$request['name_ar'],
              'name_en'=>$name_en,
          ]);
          return redirect()->back()->with(['alert' => [
              'icon' => 'success',
              'title' =>'تم التعديل',
              'text' => 'تم التعديل بنجاح'
          ]]);
      }
      public function active_member($id){
          $transfer=CommessionTransfer::find($id);
          $user=User::find($transfer->user_id);
          if($user->member_id==null){
              $user->member_id=$transfer->member->id;
          }else{
              $user->member_id=Null;
          }
          $user->save();
            return redirect()->back()->with(['alert' => [
              'icon' => 'success',
              'title' =>'تم',
              'text' => 'تم بنجاح'
          ]]);
      }
}
