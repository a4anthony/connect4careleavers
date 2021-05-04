<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'website',
        'country',
        'city',
        'avatar',
        'is_admin',
        'is_active',
    ];

    protected $appends = ['current_friend', 'request_received', 'request_sent'];


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

    /**
     * User friends
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }

    /**
     * Set created at
     *
     * @param $value
     *
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M j, Y');
    }

    public function getAvatarAttribute($value)
    {
        if($value){
            return $value;
        }
        $name = $this['name'];
        $fname = explode(' ', $name)[0];
        $lname = explode(' ', $name)[1];
        $abrr = substr($fname, 0, 1) . substr($lname, 0, 1);

        return 'https://via.placeholder.com/400x400.png/0088dd?text=' .$abrr;
    }

    /**
     * Check current friend status
     *
     *
     * @return bool
     */
    public function getCurrentFriendAttribute()
    {
        $check1 = Friend::where([
            ['status', true],
            ['user_id', $this->attributes['id']],
            ['friend_id', request()->user()->id]
        ])->exists();
        $check2 = Friend::where([
            ['status', true],
            ['user_id', request()->user()->id],
            ['friend_id', $this->attributes['id']]
        ])->exists();
        if ($check1 || $check2) {
            return true;
        }
        return false;
    }

    /**
     * Check request sent status
     *
     *
     * @return mixed
     */
    public function getRequestSentAttribute()
    {
        return Friend::where([
            ['status', false],
            ['user_id', request()->user()->id],
            ['friend_id', $this->attributes['id']
            ]
        ])->exists();
    }

    /**
     * Check request received status
     *
     *
     * @return mixed
     */
    public function getRequestReceivedAttribute()
    {
        return Friend::where([
            ['status', false],
            ['user_id', $this->attributes['id']],
            ['friend_id', request()->user()->id]
        ])->exists();
    }

    /**
     * User messages
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
