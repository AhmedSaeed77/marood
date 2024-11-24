<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\userController;
use App\Http\Controllers\areaController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\receiptBankController;
use App\Http\Controllers\membershipController;
use App\Http\Controllers\whyContactController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\whyInfractionController;
use App\Http\Controllers\infractionController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\filterController;
use App\Http\Controllers\postAddController;
use App\Http\Controllers\SlidearController;
use Illuminate\Http\Request;

use Egyjs\Arb\Facades\Arb;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/Artisan', function () {
    Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    echo 'success';
});




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){ //...

    Auth::routes(['verify' => true]);
  Route::namespace('Auth')->group(function () {
        Route::post('/login/custome',[LoginController::class,'process_login'])->name('logincustome');
 });



        // ----------------logout---------------------------
        Route::get('logout/View',[siteController::class,'logout'])->name('logoutView');
        // -----------------index page-----------------------
        
        Route::get('/search-areas',[siteController::class,'search'])->name('areas.search');
        Route::get('check-real-state-type',[siteController::class,'checkRealStateType'])->name('check-real-state-type');//real state
        Route::get('/contact/us',[siteController::class,'contact'])->name('contact');
        Route::post('/store/contact',[siteController::class,'store_contact'])->name('store_contact');
        Route::get('/',[siteController::class,'index'])->name('index')->middleware('verify-user');
        Route::post('/tagFilter',[filterController::class,'mainFilter'])->name('tagFilter');
        Route::get('/tag/{id}/{meta_title?}',[filterController::class,'mainF'])->name('cat-tag');
        Route::post('/hasChild',[filterController::class,'hasChild'])->name('hasChild');
        Route::get('/search',[filterController::class,'search'])->name('search');
        Route::post('/tag/Filter/Only/New',[filterController::class,'tagFilterOnlyNew'])->name('tagFilterOnlyNew');
        Route::post('/tag/Filter/Only/Diesel',[filterController::class,'tagFilterOnlyDiesel'])->name('tagFilterOnlyDiesel');
        Route::post('/tag/Filter/Only/Concession',[filterController::class,'tagFilterOnlyConcession'])->name('tagFilterOnlyConcession');
        Route::post('/tag/Filter/Only/Scraping',[filterController::class,'tagFilterOnlyScraping'])->name('tagFilterOnlyScraping');
        Route::post('/tag/filter/created',[filterController::class,'filterByCreatedAt'])->name('filterByCreatedAt');
        Route::get('/city/{city_id}',[filterController::class,'city_search']);
        Route::get('/city/{city_id}/{cat_id}',[filterController::class,'city_cat_search']);
        Route::post('/get_main_cat',[filterController::class,'get_main_cat'])->name('get_main_cat');
        Route::post('/get_subcat',[filterController::class,'get_subcat'])->name('get_subcat');
        Route::post('/get_cat_year',[filterController::class,'get_cat_year'])->name('get_cat_year');
        Route::post('/get_parentcat',[filterController::class,'get_parentcat'])->name('get_parentcat');
        Route::post('/get/post/area',[filterController::class,'get_post_area'])->name('get_post_area');
        Route::post('/city_ajax',[filterController::class,'city_ajax'])->name('city_ajax');
        Route::post('/get_area_children',[filterController::class,'get_area_children'])->name('get_area_children');
        Route::get('/lang',[siteController::class,'lang'])->name('lang');
        Route::get('/session/{id}',[siteController::class,'session']);
        Route::get('/delSession',[siteController::class,'delSession'])->name('delSession');
        Route::get('/get_session_ajax',[filterController::class,'get_session_ajax'])->name('get_session_ajax');
        Route::get('/more/cats',[siteController::class,'more_cats'])->name('more_cats');
        Route::post('/get/cat',[filterController::class,'get_cat'])->name('get_cat');
        Route::post('/search/modal',[filterController::class,'search_with_modal'])->name('search_with_modal');
        // -----------------footer pages------------------
        Route::get('/footer/{id}/page/{link}',[siteController::class,'footer_page']);
        Route::get('tender-deal',[siteController::class,'tenderDeal'])->name('tenderDeal');
        //     --------------commission------------
        Route::get('/commission',[siteController::class,'commission'])->name('commission');
        Route::get('/member/{id}',[siteController::class,'member_ship'])->name('member');
        Route::get('/member/{id}/packages',[siteController::class,'packages'])->name('packages');
        Route::post('/user/add/transfer',[siteController::class,'user_transfer'])->name('user.add.transfer')->middleware('auth');
        Route::post('/user/store/transfer',[siteController::class,'user_store_transfer'])->name('user.store.transfer')->middleware('auth');

        Route::get('pay/commission',[siteController::class,'pay_commission'])->name('pay_commission');
        // ----------------single post ---------------------
        Route::get('/single/post/{id}/{slug?}',[siteController::class,'single_post'])->name('single_post');
        Route::get('delete/comment/{id}',[siteController::class,'delete_comment'])->name('delete.comment');

        Route::post('comment/post/{post_id}',[siteController::class,'comment_post'])->name('comment_post')->middleware('auth');
        Route::post('follow/{id}/comment',[siteController::class,'follow_comment'])->name('follow_comment')->middleware('auth');
        Route::get('post/{post_id}/fav',[siteController::class,'fav_post'])->middleware('auth')->name('fav_post_link');
        Route::post('post/{post_id}/infraction',[siteController::class,'post_infraction'])->name('post_infraction')->middleware('auth');
        Route::post('comment/infraction',[siteController::class,'comment_infraction'])->name('comment_infraction')->middleware('auth');
        Route::get('fav/posts',[siteController::class,'fav_posts'])->name('fav_posts');
        Route::post('change/comment/show',[siteController::class,'change_comment_show'])->name('change_comment_show');
        Route::post('show/on/map',[siteController::class,'show_on_map'])->name('show_on_map');
        Route::post('update/post/date',[siteController::class,'update_post_date'])->name('update_post_date');
        Route::get('edit/{id}/single/post',[siteController::class,'edit_single_post'])->name('edit_single_post');
        Route::post('update/area/post',[siteController::class,'update_area_post'])->name('update_area_post');
        Route::post('update/single/user_post/{id}',[postAddController::class,'update_single_user_post'])->name('update_single_user_post')->middleware('auth');
        Route::get('delete/single/user_post/image/{id}',[postAddController::class,'delete_image'])->middleware('auth');
        Route::post('delete/single/user_post/video/{id}',[postAddController::class,'delete_video'])->middleware('auth');
        Route::get('del/{post_id}/post/user',[PostController::class,'del_post_user'])->name('del_post_user');
        //------------------add post  ------------------------
        Route::get('choose/cat/add/post',[postAddController::class,'choose_cat_add_post'])->name('choose_cat_add_post')->middleware('auth');
        Route::get('contract/{cat_id}',[postAddController::class,'contract_add_post'])->middleware('auth');
        Route::get('choose/area/{cat_id}/add/post',[postAddController::class,'choose_area_add_post'])->name('choose_area_add_post')->middleware('auth');
        Route::get('photo/add/post/{cat_id}/{area_id}',[postAddController::class,'choose_photo_add_post'])->middleware('auth');
        Route::post('post/info/add_post/{cat_id}/{area_id}',[postAddController::class,'add_post_photo_infos'])->name('post_infos_add_post')->middleware('auth');
        Route::post('store/post/{area_id}',[postAddController::class,'store_post'])->name('store_post_user')->middleware('auth');
        // -------------------user----------------------------
        Route::get('user/{user_id}/profile',[siteController::class,'user_profile'])->name('user_profile');
        Route::get('user/rates/{id}/show',[siteController::class,'user_rate'])->name('user_rates');
        Route::get('add/rate/user/{id}',[siteController::class,'add_rate'])->name('add_rate')->middleware('auth');
        Route::post('store/user/rate/{id}',[siteController::class,'store_rate'])->name('store_rate')->middleware('auth');
       Route::post('follow/Cat',[siteController::class,'followCat'])->name('followCat');

    // -----------------conversation----------------------
        Route::get('conversation',[siteController::class,'conversation'])->name('conversation');
        Route::post('send/msg',[siteController::class,'send_msg'])->middleware('auth')->name('send_msg');
        Route::get('chat/conv/{id}/delete',[siteController::class,'chat_conv_delete'])->name('chat_conv_delete');
        Route::get('user/chat',[siteController::class,'chat'])->middleware('auth');
        Route::get('/chat/conv/{conv_id}',[siteController::class,'chat_conv'])->middleware('auth')->name('chat_conv');
        Route::post('send/msg/chat',[siteController::class,'send_msg_chat'])->name('send_msg_chat');
        Route::get('new/conv/{user_id}',[siteController::class,'new_conv'])->name('new_conv')->middleware('auth');
        Route::post('search/user',[siteController::class,'search_user'])->name('search_user');
        //    =======================================================
        //    =======================userController==================
        //    =======================================================
        Route::post('follow/user',[userController::class,'follow_user'])->name('follow_user')->middleware('auth');
        Route::get('user/{use_id}/edit/store',[userController::class,'edit_store'])->name('edit_store');
         Route::get('edit/identifier',[userController::class,'edit_identifier'])->name('edit_identifier')->middleware('auth');
        Route::get('user/notification',[userController::class,'user_notify'])->name('notification');
        Route::get('user/edit/store/map',[userController::class,'edit_map'])->name('edit_store_map')->middleware('auth');
        Route::post('update/user/store/map',[userController::class,'update_user_store_map'])->name('update_user_store_map');
        Route::post('user/add/identify',[userController::class,'add_identify'])->name('add_identify')->middleware('auth');
        Route::post('update/user/store',[userController::class,'update_user_store'])->name('update_user_store')->middleware('auth');
        Route::get('update/user/{type}/main/info',[userController::class,'update_user'])->name('update_user')->middleware('auth');
        Route::post('edit/user/main/{type}/info',[userController::class,'edit_user'])->name('edit_user_main_info')->middleware('auth');
        Route::post('change/password',[userController::class,'change_password'])->name('change_password')->middleware('auth');
                  Route::post('search/user/blackList',[userController::class,'search_user_blackList'])->name('search_user_blackList');
      //    ------------notification--------------
       Route::get('notification/{id}/show',[userController::class,'notification_show'])->name('notification_show');
       Route::get('notification/{id}/show/#{comment_id}',[userController::class,'notification_show'])->name('notification_show_comment');
       Route::get('notification/{id}/show/user',[userController::class,'notification_show_user'])->name('notification_show_user');
       Route::get('delete/notification',[userController::class,'del_notification'])->name('del_notification');
       Route::get('followUp/user',[userController::class,'follow_up'])->name('follow_up');
    //   --------------follow----------------------
       Route::post('cancel/follow/user',[userController::class,'cancel_follow_user'])->name('cancel_follow_user');
       Route::post('cancel/follow/cat',[userController::class,'cancel_follow_cat'])->name('cancel_follow_cat');
       Route::post('cancel/follow/post',[userController::class,'cancel_post_follow'])->name('cancel_post_follow');
    //    -------------------verify store----------------
       Route::get('verify/store/user/{user_id}',[userController::class,'verify_store'])->name('verify_store')->middleware('auth');
       Route::get('verify/store/user/{user_id}/abshar',[userController::class,'verify_with_abshar'])->name('verify_with_abshar')->middleware('auth');
       Route::post('store/verify/type',[userController::class,'store_verify'])->name('store_verify_type')->middleware('auth');
       Route::get('verify/with/documentation',[userController::class,'verify_with_documentation'])->name('verify_with_documentation')->middleware('auth');
       Route::get('verify/documentation/licence',[userController::class,'verify_with_documentation2'])->name('verify_doc_2')->middleware('auth');

    });
      //=======================================================================================
      //==================================admin panel==========================================
      // =======================================================================================
      
      
      Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

Route::group([

    'prefix' => 'admin',
    'middleware' =>['role:admin|superAdmin','auth']
],function(){
        Route::get('/index', function () {
            return view('admin.index');
        })->name('dashboard');
        Route::get('icons',function(){
            return view('admin.icons');
        });
        Route::get('all/notifications',[userController::class,'admin_noti']);
        // =============ٌrolesController==============
        Route::get('/roles/index',[rolesController::class,'index'])->name('roles.index');
        Route::get('/user/{id}/roles',[rolesController::class,'user'])->name('user.roles');
        Route::post('/user/{id}/roles/assign',[rolesController::class,'assignRole'])->name('assign.Role');
        // =============AreaController================
        Route::resource('/area',areaController::class);
        Route::get('/country/{id}/city',[areaController::class,'city_show'])->name('area.city');
        //=================PostController==============
        Route::resource('/posts',PostController::class);
        Route::get('posts/show/{not_id}',[PostController::class,'showNot']);
        Route::get('/posts/{id}/active',[PostController::class,'active'])->name('posts.active');
        Route::get('/posts/{id}/images',[PostController::class,'post_images'])->name('posts.images');
        Route::get('/posts/img/{img_id}/del',[PostController::class,'del_image'])->name('del_img');
        Route::post('/posts/{post_id}/add_img',[PostController::class,'add_image'])->name('post_add_img');
        Route::post('/posts/{img_id}/update_img',[PostController::class,'update_img'])->name('update_img');
        Route::get('/posts/{id}/edit_map',[PostController::class,'edit_map'])->name('posts.edit.map');
        Route::post('/update_post_map/{id}',[PostController::class,'update_post_map'])->name('update_post_map');
        Route::get('Posts/{id}/enable/comment',[PostController::class,'enable_post_comment'])->name('posts.enable.comment');
        Route::get('Posts/{id}/show/comment',[PostController::class,'show_comment'])->name('posts.show.comment');
        Route::get('posts/comment/{id}/destroy',[PostController::class,'del_comment'])->name('comment.destroy');
        Route::get('post/{id}/delete',[PostController::class,'destroy'])->name('del_post');
        Route::get('posts/{id}/is_pay',[PostController::class,'is_pay'])->name('posts.is_pay');
        // ==================CatController=============
        Route::get('/cats/index',[CatController::class,'index'])->name('cat_index');
        Route::get('/cats/create',[CatController::class,'create']);
        Route::post('/cats/store',[CatController::class,'store'])->name('cat.store');
        Route::get('/cats/{id}/child',[CatController::class,'show_child'])->name('show_child');
        Route::get('/del_cat/{id}',[CatController::class,'destroy'])->name('del_cat');
        Route::get('/update_cat/{id}',[CatController::class,'edit'])->name('update_cat');
        Route::post('/cats/edit/{id}',[CatController::class,'update'])->name('edit_cat');
        Route::post('/cats/getSubCat',[CatController::class,'getSubCat'])->name('getSubCat');
        // ==================userController=============
        Route::get('/users/index',[userController::class,'index']);
        Route::get('/members/index',[userController::class,'members'])->name('members');

        Route::resource('/users',userController::class);
        Route::get('/create/member',[userController::class,'createMember'])->name('admin.create-member');
        Route::post('/store/member',[userController::class,'storeMember'])->name('admin.store-member');

        Route::get('/del_user/{id}',[userController::class,'destroy'])->name('del_user');
        Route::get('/user_active/{id}',[userController::class,'active']);
          Route::get('/user_active/black/{id}',[userController::class,'black_user']);

        Route::get('/store/index',[userController::class,'store_index']);
        Route::get('/accept/store/verify/{id}',[userController::class,'accept_verify']);
     Route::post('admin/edit/user/{id}',[userController::class,'admin_edit_user'])->name('admin_edit_user');
     Route::get('users/show/{not_id}',[userController::class,'users_show_not']);
       // ===================areaController===============
       Route::post('/getcity',[areaController::class,'getCity'])->name('getcity');
      // ====================pagesController==============
       Route::resource('/pages',pagesController::class);
       Route::get('pages/{id}/questions',[pagesController::class,'questions'])->name('pages.questions');
       Route::post('pages/destroy/question/{id}',[pagesController::class,'del_question'])->name('pages.destroy.question');
       Route::post('pages/add/{page_id}/question',[pagesController::class,'add_question'])->name('pages.add.question');
       Route::post('pages/edit/{qestion_id}/question',[pagesController::class,'edit_question'])->name('pages.edit.question');
      //    =================settingController=============
       Route::get('/setting',[settingController::class,'index'])->name('setting.index');
       Route::post('/setting/update',[settingController::class,'update'])->name('setting.update');
       Route::get('/setting/banks',[settingController::class,'bank'])->name('setting.banks');
       Route::post('/setting/add-banks',[settingController::class,'addBank'])->name('setting.add.banks');
       Route::post('/setting/{id}/update_bank',[settingController::class,'updateBank'])->name('update_bank');
       Route::get('/setting/{id}/del_bank',[settingController::class,'delBank'])->name('del_bank');
       Route::get('/setting/receiptBank',[receiptBankController::class,'index'])->name('setting.reciptBank');
       Route::get('/setting/wm',[settingController::class,'wm_index'])->name('setting.wm');
       Route::post('/setting/update/wm',[settingController::class,'vm_update'])->name('setting.wm');
       Route::get('/setting/filter',[settingController::class,'filter_menue'])->name('filter');
       Route::post('/setting/filter/{id}',[settingController::class,'update_menue_filter'])->name('update_menue_filter');
       Route::get('/setting/menues/{id}/item',[settingController::class,'menues_item'])->name('menues_item');
       Route::post('/setting/menue/{id}/add/item',[settingController::class,'add_menue_item'])->name('add_menue_item');
       Route::get('/setting/del/{id}/item',[settingController::class,'del_item_menue'])->name('del_item_menue');
       Route::post('/update/menue/item/{id}',[settingController::class,'update_menue_item'])->name('update_menue_item');
       Route::get('setting/time/transfer',[settingController::class,'time_transfer'])->name('setting.time.transfer');
       Route::post('setting/time/transfer/create',[settingController::class,'create_time_transfer'])->name('setting.time.transfer.create');
       Route::get('setting/time/transfer/{id}/destroy',[settingController::class,'destroy_time_transfer'])->name('setting.time.transfer.destroy');
    //   =====================membershipController==========
       Route::get('/memberShip/index',[membershipController::class,'index'])->name('memberShip.index');
       Route::get('/memberShip/create',[membershipController::class,'create'])->name('memberShip.create');
       Route::get('/memberShip/destroy/{id}',[membershipController::class,'destroy'])->name('memberShip.destroy');
       Route::get('/memberShip/edit/{id}',[membershipController::class,'edit'])->name('memberShip.edit');
       Route::post('/memberShip/store',[membershipController::class,'store'])->name('member.store');
       Route::post('/memberShip/update/{id}',[membershipController::class,'update'])->name('member.update');
       Route::get('/memberShip/{id}/price/subscripe',[membershipController::class,'memberSubscripe'])->name('memberShip.price.subscripe');
       Route::get('/member/package/{id}/destroy',[membershipController::class,'package_destroy'])->name('member.package.destroy');
       Route::post('/member/{id}/package/create',[membershipController::class,'package_create'])->name('member.package.create');
       Route::post('/member/{id}/package/update',[membershipController::class,'package_update'])->name('member.package.update');

         //    ----------------question fo member pages--------------
       Route::get('member/{id}/Question/Page',[membershipController::class,'question'])->name('memberQuestionPage');
       Route::post('member/page/destroy/question/{id}',[membershipController::class,'del_question'])->name('member.pages.destroy.question');
       Route::post('member/page/add/{page_id}/question',[membershipController::class,'add_question'])->name('member.pages.add.question');
       Route::post('member/page/edit/{qestion_id}/question',[membershipController::class,'edit_question'])->name('member.pages.edit.question');
             //  --------------------commission-------------
       Route::get('/commission/index',[membershipController::class,'commession_index'])->name('commission.index');
       Route::get('/Commission/{id}/destroy',[membershipController::class,'commession_destroy'])->name('Commission.destroy');
       Route::post('/Commission/{id}/edit',[membershipController::class,'commission_update'])->name('Commission.edit');
       Route::post('/Commission/create',[membershipController::class,'commission_create'])->name('commission.create');
       Route::get('active/membership/{transfer_id}',[membershipController::class,'active_member'])->name('active_member');
    //  ====================whyContactController=============
       Route::resource('whyContact',whyContactController::class);
    // =====================ContactController================
       Route::resource('contact',ContactController::class);
       Route::get('contact/show/{not_id}',[ContactController::class,'show_contact']);
    // ====================whyInfractionController===========
    Route::resource('whyInfraction',whyInfractionController::class);
        // =====================infractionController================
        Route::resource('infraction',infractionController::class);
               Route::get('infraction/show/{not_id}',[infractionController::class,'show_infraction']);
      // ==========================SlidearController===========================
             Route::resource('/slidear',SlidearController::class);

      // =====================================================
    Route::get('/addWatermark', function()
    {
        $img = Image::make(public_path('images/main.png'));

        /* insert watermark at bottom-right corner with 10px offset */
        $img->insert(public_path('images/logo.jpg'), 'bottom-right', 10, 10);

        $img->save(public_path('images/main-new1.png'));

        dd('saved image successfully.');
    });
});
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('get-tags',[siteController::class,'getTags'])->name('get-tags');
Route::get('/city/{city_id}/{cat_id}',[filterController::class,'city_category_search']);



Route::post('payment-initiate-commission',[PaymentController::class,'initiatePaymentCommission'])->name('payment-initiate-commission');
Route::post('payment-initiate',[PaymentController::class,'initiatePayment'])->name('payment-initiate');
Route::post('response/success',[PaymentController::class,'callBackUrlSuccess']);
Route::post('response/failed',[PaymentController::class,'callBackUrlFailed']);




// Route::post('payment-initiate', function (Request $request){
    

//     $responce = Arb::initiatePayment($request->amount); // 100 to be paid

//     // return $responce;
//     /** @example
//     {#
//     +"success": true
//     +"url": "https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=?paymentId=000000000000000000"
//     }
//      */
     
//      return redirect()->away($responce->url);


// })->name('payment-initiate');



// Route::post('/arb/response', function (Request $request) {
//     if ($request->status == 'success') {
//       return "Success Payment Transaction";
//     } else {
//         return "Failed Payment Transaction";

//     }
// });




// Route::get('/update/email', function () {
//     \Illuminate\Support\Facades\DB::table('users')->update(['email_verified_at' => \Carbon\Carbon::now()]);
    
//     return "Done Update";

// });

