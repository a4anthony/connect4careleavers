<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(
            'author',
            function ($builder) {
                $builder->with('author');
            }
        );

        static::addGlobalScope(
            'likes',
            function ($builder) {
                $builder->with('likes');
            }
        );


    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(LikeComment::class, 'comment_id', 'id');
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }


}
