<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];

    protected $appends = ['liked_by_current_user'];

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
            'comments',
            function ($builder) {
                $builder->with('comments');
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

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }


    public function getLikedByCurrentUserAttribute()
    {
        return Like::where([['user_id', request()->user()->id], ['post_id', $this->attributes['id']]])->exists();
    }
}
