<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Video extends Model
{
    protected $table = 'videos';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 1 to many
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * many to many
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'video_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * 1 to many polymorphic
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     * many to many polymorphic
     */
    public function morphToTags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     * one to one polymorphic
     */
    public function thumbnail()
    {
        return $this->morphOne('App\File', 'fileable');
    }
}
