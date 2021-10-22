<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App
 *
 * @property $posts
 */
class Tag extends Model
{
    protected $table = 'tags';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany('App\Video', 'video_tag');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function morphByPosts()
    {
        return $this->morphedByMany('App\Post', 'taggable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     * many to many polymorphic
     */
    public function morphByVideos()
    {
        return $this->morphedByMany('App\Video', 'taggable');
    }
}
