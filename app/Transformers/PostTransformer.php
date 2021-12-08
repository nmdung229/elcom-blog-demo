<?php
namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    /**
     * @param Post $post
     * @return array
     */
    public function transform(Post $post)
    {
        return [
          'title' => $post->title,
          'slug' => $post->slug
        ];
    }
    public function transformWithThumbnail(Post $post)
    {
        return [
          'title' => $post->title,
        ];
    }

}
