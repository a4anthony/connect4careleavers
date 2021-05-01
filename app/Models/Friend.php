<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected  $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(
            'friend',
            function ($builder) {
                $builder->with('friend');
            }
        );
        static::addGlobalScope(
            'user',
            function ($builder) {
                $builder->with('user');
            }
        );

    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
