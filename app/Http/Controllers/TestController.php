<?php

namespace App\Http\Controllers;

use App\Comment;
use App\File;
use App\Post;
use App\Tag;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     *
     */
    public function userCheck()
    {
        // TEST 2 relation posts va videos ok
        // tra ve cac bai viet thuoc user co id=1
//        $posts = User::findOrFail(1)->posts;
        $videos = User::findOrFail(1)->videos;
        dd($videos);
    }

    public function tag()
    {
        // TEST 2 relation posts va videos ok
//        cac bai viet co chua tag co id=1
//        $posts_has_tag = Tag::findOrFail(1)->posts;
//        dd($posts_has_tag);
        // cac video co chua tag co id=1

//        $videos_has_tag = Tag::findOrFail(1)->videos;
//        dd($videos_has_tag);

        $video_morph = Tag::find(1)->morphByVideos;
        dd($video_morph);
    }

    public function video()
    {
        $tags_belongTo_video = Video::find(1)->tags;

        $tags_morph = Video::find(1)->morphToTags;
        dd($tags_morph);
        $comments_of_video = Video::find(1)->comments;

        dd($comments_of_video);
    }

    public function post()
    {
//        $data = Post::find(1)->comments;
        $data = Post::find(1)->tags;
        dd($data);
    }

    public function comment()
    {
        $data = Comment::find(5)->commentable;
        dd($data);
    }

    public function collections()
    {
        $data = User::all();
        $data = $data->makeHidden(['email', 'created_at']);
//        return json_encode($data);
//        dd($data);
        dd((User::whereIn('id', [8,9]))->toSql());
//        dd($data->diff((User::whereIn('id', [8,9]))->get()));
//        $user = User::where('name', 'Belier')->get();
//        $query = $user->toQuery()->update([
//            'name' => 'Linh Do'
//        ]);
//        dd($query);
    }
    public function thumbnail()
    {
        $filable = File::where(['fileable_id' => 1, 'fileable_type' => 'App\Video'])->get();
        dd($filable);
    }
    // vieets theo repository pattern
    // crud video, posts can upload files
    // cos filter theo tags, search theo name, description
    // 12 gio trua mai
    public function filter($title)
    {
        $result = Post::where('title', 'like', '%' . $title . '%')->get();
        dd($result);
    }

    public function filterByTag($tag_id)
    {
//        $result = Tag::find($tag_id)->videos;
        $tag = Tag::find($tag_id);
        dd($tag->morphByVideos);
        $result = Tag::find($tag_id)->morphedByVideos;
        dd($result);
    }

}
