<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

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
            'likes',
            function ($builder) {
                $builder->with('likes');
            }
        );


    }

    /**
     * Comment author
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Comment likes
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(LikeComment::class, 'comment_id', 'id');
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
     * Check liked status
     *
     *
     * @return mixed
     */
    public function getLikedByCurrentUserAttribute()
    {
        return LikeComment::where([['user_id', request()->user()->id], ['comment_id', $this->attributes['id']]])->exists();
    }


}
