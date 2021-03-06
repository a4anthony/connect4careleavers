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

    /**
     * Post author
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Post comments
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    /**
     * Post likes
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
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
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Check like status
     *
     *
     * @return mixed
     */
    public function getLikedByCurrentUserAttribute()
    {
        return Like::where([['user_id', request()->user()->id], ['post_id', $this->attributes['id']]])->exists();
    }
}
