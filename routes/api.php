<?php

use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\CommisionController;
use App\Http\Controllers\Api\ConversationsController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\FollowsController;
use App\Http\Controllers\Api\InfractionsController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\RatingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PaymentController;

use Egyjs\Arb\Facades\Arb;
use Google\Client as GoogleClient;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.','middleware'=>['checkApiPassword'], 'namespace' => 'Api'], function () {
    /*
     * Map Endpoints
     */
    //Route::post('posts', [PostController::class,'index'])->name('posts.index');
});
Route::group(
    [
        'middleware' => [ 'lang' ]
    ], function(){
    // ==================authntication=============
    Route::post('register','RegisterApiController@register')->name('register');
    Route::post('login-check-code','RegisterApiController@checkCode')->withoutMiddleware('api');
    Route::post('send-otp-again','RegisterApiController@sendOtpAgain')->withoutMiddleware('api');


    Route::post('login','loginController@login')->name('login');
    Route::get('logout','loginController@logout');
    // ==================post========================
    Route::get('posts','SiteController@posts');
    Route::get('posts/{id}','SiteController@postDetails')->name('posts.details');
    // ==================page========================
    Route::get('pages','SiteController@pages');
    Route::get('page/{id}','SiteController@page');
    // ==================Category========================
    Route::get('categories/add','SiteController@catsAdd');
    

        Route::get('categories','SiteController@cats');
        Route::get('category/{id}/child','SiteController@category_child');

    // ==================Category========================
    Route::get('areas','SiteController@areas');
    Route::get('area/{id}/child','SiteController@area_child');
    // ==================bank========================
    Route::get('banks','SiteController@banks');
    // ==================contact =====================
    Route::get('why/contact','SiteController@contact_why');
    Route::post('contact','SiteController@contact');

    Route::get('post/{id}/comments' , 'CommentsController@index');

    Route::get('profile/{id}' , 'UsersController@visitProfile')->name('profile');
    Route::get('delete/profile' , [UsersController::class,'deleteAccount']);
    Route::get('settings' , 'SettingsController@index');
    Route::get('versions' , 'SettingsController@versions');


    Route::get('menus' , 'MenusController@index');

    Route::post('blacklist' , 'BlacklistController@check');

    Route::get('memberships' , 'MemberShipsController@index');
    Route::get('memberships/{membership}' , 'MemberShipsController@show');
    Route::post('add/phone',[\App\Http\Controllers\Api\UserPhoneController::class,'store']);
    Route::post('update/phone',[\App\Http\Controllers\Api\UserPhoneController::class,'update']);
    Route::get('send/notification',[\App\Http\Controllers\Api\SiteController::class,'sendNotification']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('notifications')->group(function () {
        Route::get('/' , [NotificationsController::class , 'index']);
        Route::get('/{id}' , [NotificationsController::class , 'show']);
        Route::delete('/{id}' , [NotificationsController::class , 'destroy']);
        Route::delete('/' , [NotificationsController::class , 'deleteAll']);
    });

    Route::get('profile' , [UsersController::class , 'profile']);
    Route::post('profile' , [UsersController::class , 'updateProfile']);
    Route::post('change-password' , [UsersController::class , 'changePassword']);
    Route::put('store_identify' , [UsersController::class , 'storeIdentity']);

    Route::post('user/{id}/rate' , [RatingsController::class , 'store']);
    Route::get('user/rates/{id}' , [RatingsController::class , 'getAllRates']);


    Route::get('my-posts' , [PostsController::class , 'index']);
    Route::get('delete-all' , [PostsController::class , 'DeleteAll']);
    Route::post('posts' , [PostsController::class , 'store']);
    Route::post('posts/simillar' , [PostsController::class , 'SimillarPosts']);
    Route::post('posts/{post}' , [PostsController::class , 'update']);
    Route::delete('posts/{id}' , [PostsController::class , 'destroy']);
    Route::put('posts/{post}/comments' , [PostsController::class , 'toggleComments'] );



    Route::get('block/{id}',[\App\Http\Controllers\Api\BlockController::class,'store']);
    Route::get('un-block/{id}',[\App\Http\Controllers\Api\BlockController::class,'destroy']);
    Route::get('user/blocked',[\App\Http\Controllers\Api\BlockController::class,'index']);

//    Route::post('add/rate/user',[\App\Http\Controllers\Api\SiteController::class,'userRate'])->name('userRate')->middleware('auth');
//    Route::get('user/rate/{id}',[\App\Http\Controllers\Api\SiteController::class,'getRate'])->name('getRate')->middleware('auth');

    Route::get('search',[\App\Http\Controllers\Api\SiteController::class,'search']);
    //Following List
    Route::get('followers',[FollowsController::class,'followers']);

    Route::prefix('following')->group(function () {
        //Categories
        Route::post('cats/{id}' , 'FollowsController@toggleCat');
        Route::get('cats' , 'FollowsController@followedCategories');
        //Categories
        //Members
        Route::post('members/{id}' , 'FollowsController@toggleMember');
        Route::get('members' , 'FollowsController@members');
        //Members
        //Posts
        Route::post('posts/{id}' , 'FollowsController@togglePost');
        Route::get('posts' , 'FollowsController@posts');
        //Posts
    });
    //Following List

    Route::prefix('chats')->group(function () {
        Route::get('/' , [ConversationsController::class , 'index']);
        Route::get('/{id}' , [ConversationsController::class , 'show']);
        Route::post('/{id}' , [ConversationsController::class , 'sendMsg']);
        Route::post('/new/{id}' , [ConversationsController::class , 'newChat']);
        Route::get('get-chat-by-user-id/{id}' , [ConversationsController::class , 'chatDetailsByUserId']);
        Route::delete('/{id}' , [ConversationsController::class , 'destroy']);
    });


    Route::prefix('favourites')->group(function () {
        Route::get('/' , [FavouriteController::class , 'index']);
        Route::post('/{id}' , [FavouriteController::class , 'store']);
    });



    Route::post('post/{id}/comments' , 'CommentsController@store');
    Route::delete('comments/{id}' , 'CommentsController@delete');
    Route::post('comments/{id}/replies' , 'CommentsController@reply');

    Route::prefix('commission')->group(function () {
        Route::post('/' , [CommisionController::class , 'store']);
        Route::get('/' , [CommisionController::class , 'index']);
    });


    //Infractions

    Route::prefix('infractions')->group(function () {
        Route::get('/' , [InfractionsController::class , 'index']);
        Route::post('/post/{id}' , [InfractionsController::class , 'reportPost']);
        Route::post('/comment/{id}' , [InfractionsController::class , 'reportComment']);
    });

    //Infractions
    
     ############ last update of islam mohamed #######################################################
    Route::post('inquiries/store','InquiryController@store');
    Route::get('inquiries/show/{id}','InquiryController@show');
    Route::post('inquiries/update/{id}','InquiryController@update');
    Route::get('inquiries/by-category-id/{id}','InquiryController@getById');
    Route::get('inquiries/all-by-user/{id}','InquiryController@allByUser');
    Route::delete('inquiries/delete-one/{id}','InquiryController@delete');
    Route::post('follow/cat/{id}','InquiryController@followCategory');
    Route::post('unfollow/cat/{id}','InquiryController@unFollowCategory');
    Route::get('stories','InquiryController@stories');
    Route::post('add-comment','InquiryController@addComment');
    Route::post('inquiries/add-love/{id}','InquiryController@addLove');
    Route::post('inquiries/delete-love/{id}','InquiryController@deleteLove');




});

Route::post('forget-password','ResetPassword\ForgetPasswordController@forgetPassword');
Route::post('check-code','ResetPassword\ForgetPasswordController@checkCode');
Route::post('reset-password','ResetPassword\ForgetPasswordController@resetPassword');
Route::get('payment-status','SettingsController@paymentStatus');


Route::post('payment-initiate',[PaymentController::class,'initiatePayment']);

// Route::post('/arb/response',[PaymentController::class,'callBackUrl']);

Route::post('/arb/success',[PaymentController::class,'callBackUrlSuccess']);
Route::post('/arb/failed',[PaymentController::class,'callBackUrlFailed']);


// Route::post('payment-initiate', function (Request $request){

//     $responce = Arb::initiatePayment($request->input('amount')); // 100 to be paid

//     return $responce;
//     /** @example
//     {#
//     +"success": true
//     +"url": "https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=?paymentId=000000000000000000"
//     }
//      */

// });





Route::get('/firebase', function () {

    $fcm = "cLpErul1RD-hzhhpxzEKPX:APA91bHIOS5XhdyFDWc6woBpeGLVy9e42gjQl6gPy1UZAVhWe_XHxTR6v3MNvmarXQOeczadpeikDY5Qj0ogfJ-DshFLIdrZve0Al42JbuFtf9oLQZF66ofT7ySiVqxClK9qirAtgmw7";
    $title = "اشعار جديد";
    $description = "رساله جديده لديك";
    $credentialsFilePath = Http::get(asset('public/json/maarod-c04bb-2788dd2f1018.json'));
    $client = new GoogleClient();
    $client->setAuthConfig($credentialsFilePath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    $token = $client->getAccessToken();
    $access_token = $token['access_token'];

    $headers = [
        "Authorization: Bearer $access_token",
        'Content-Type: application/json'
    ];
    $data = [
        "message" => [
            "token" => $fcm,
            "notification" => [
                "title" => $title,
                "body" => $description,
            ],
        ]
    ];
    $payload = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/haraj-quick/messages:send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        return response()->json([
            'message' => 'Curl Error: ' . $err
        ], 500);
    } else {
        return response()->json([
            'message' => 'Notification has been sent',
            'response' => json_decode($response, true)
        ]);
    }
});

