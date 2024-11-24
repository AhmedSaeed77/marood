<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\ResetPassword as CustomResetPassword;


//implements MustVerifyEmail
class User extends  Authenticatable implements JWTSubject,MustVerifyEmail

{
    use HasFactory, Notifiable;
    use HasRoles;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
    
    
      public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function role(){
        return $this->belongsTo('App\Models\role','role_id');
    }
    public function memberShip(){
        return $this->belongsTo('App\Models\MemberShip','member_id');
    }
    public function user_posts(){
        return $this->belongsToMany(Post::class,'user_posts')->where('active',1);
    }

    public function fav_posts(){
        return $this->hasMany('App\Models\FavPosts','user_id');
    }

    public function sendConver(){
        return $this->hasMany('App\Models\Conversation','user_id');
    }
    public function follower(){
        return $this->hasMany('App\Models\Follow_user','follow_user_id');
    }
    public function memberFollow(){
        return $this->hasMany('App\Models\Follow_user','user_id');
    }
    public function recievConver(){
        return $this->hasMany('App\Models\Conversation','follow_user_id');
    }
    public function recieveMsg(){
        return $this->hasMany('App\Models\Msg_Conversation','reciever');
    }

    public function userRate(){
        return $this->hasMany('App\Models\user_rate','rate_for_userid');
    }
    public function rates(){
        return $this->hasMany(Rate::class,'rater_id');
    }
    public function alreadyRate($user_id){
        return self::rates()->where('user_id',$user_id)->exists();
    }
    public function userFollowCat(){
        return $this->hasMany('App\Models\followCat','user_id')->with('Cat');
    }
    public function userFollowPost(){
        return $this->hasMany('App\Models\FollowComment','user_id');
    }
    public function Contact(){
        return $this->hasMany('App\Models\UserContact','user_id');
    }


    public function getRatingAvgAttribute() {
        $score = 0;
        foreach($this->userRate as $rate){
            $score=$score+$rate->recommend;
        }
        $countPositive=count($this->userRate->where('recommend',1) );
        $countNegative=count($this->userRate->where('recommend',0) );
        $rates =floor(($countPositive * 5 + $countNegative * 1) /5);
        return $rates;

    }

    public function checkFollow() :bool {
        if (! Auth::guard('api')->user())
            return 0;
        $exists = Follow_user::where([
            'user_id'=>Auth::guard('api')->user()->id ,
            'follow_user_id' => $this->getKey()
        ])->exists();
        if($exists)
            return 1;

        return 0;
    }

    public function commissionPayed()
    {
        $isPayed = 1;
        foreach ($this->user_posts as $post) {
            if ($post->is_pay == 0) {
                $isPayed = 0;
            } else {
                $isPayed = 1;
            }
        }
        return $isPayed;
    }
    public  function phones(){
        return $this->hasMany(UserPhone::class,'user_id');
    }
    public function isFollowed(){
        $followed = 0;
        $followedOrNot = 0;
        if (Auth::guard('api')->user()){
            $followedOrNot = Follow_user::where([
                'follow_user_id' => $this->getKey(),
                'user_id' => Auth::guard('api')->user()->id
            ])->exists();
        }
        $followedOrNot ? $followed = 1 : $followed = 0;
        return $followed;
    }
    public function averagerate(){
        return $this->hasMany(user_rate::class);
    }

    public function alreadyBlocked(){
        return Block::where('user_id',Auth::guard('api')->user()->id)
            ->where('blocked_id',$this->getKey(''))
            ->exists()?1:0;
    }
    public function block_users(){
        return $this->hasMany(Block::class,'user_id');
    }
}
