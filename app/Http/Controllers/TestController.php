<?php

namespace App\Http\Controllers;

use App\Category;
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

    public function testSwagger()
    {
        return view('swagger.index');
    }
    public function swagger1SKServer()
    {
        return view('swagger.swagger1sk');
    }

    public function swagger1skLocal()
    {
        return view('swagger.swagger1skLocal');
    }

    public function swagger1sk()
    {
        return view('swagger.1sk');
    }

    public function myFunction($category_id)
    {
        $category_ids[] = (int)$category_id;
        $category = Category::find($category_id);
        if($category) {
            $this->getAllCategoryID($category_ids, $category);
        }
        dd($category_ids);
//        $data = Category::whereIn('id', $category_ids);
//        return responses()->json([
//            'data' => $data
//        ]);
    }
    public function getAllCategoryID(&$category_ids, $category)
    {
        $child_category = Category::where('parent_id', $category->id)->get();
        if(count($child_category) > 0) {
            foreach($child_category as $value) {
                $category_ids[] = $value->id;
                $this->getAllCategoryID($category_ids, $value);
            }
        }
    }
}
