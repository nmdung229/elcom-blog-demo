<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 *
 */
class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function morphToTags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function thumbnail()
    {
        return $this->morphOne('App\File', 'fileable');
    }

}
