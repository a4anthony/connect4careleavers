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

    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }

    public function friendRequestsReceived()
    {
        return $this->hasMany(Friend::class, 'friend_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M j, Y');
    }


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

    public function getRequestSentAttribute()
    {
        return Friend::where([
            ['status', false],
            ['user_id', request()->user()->id],
            ['friend_id', $this->attributes['id']
            ]
        ])->exists();
    }

    public function getRequestReceivedAttribute()
    {
        return Friend::where([
            ['status', false],
            ['user_id', $this->attributes['id']],
            ['friend_id', request()->user()->id]
        ])->exists();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
