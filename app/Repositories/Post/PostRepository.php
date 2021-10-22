<?php

namespace App\Repositories\Post;

use App\Post;
use App\File;

use App\Repositories\BaseRepository;
use App\Tag;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return  \App\Post::class;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
        $is_active = 0;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        //luu vào csdl
        $post = new Post();
        $post->title = $request->input('title'); // tiêu đề bài viết
        $post->slug = Str::slug($request->input('title'));

        $post->content = $request->input('content'); // nội dung bài viết
        $post->position = $request->input('position'); // vị trí bài viết
        if ($request->has('is_hot')){ // kiểm tra xem có tồn tại key is_hot không?
            $post->is_hot = $request->input('is_hot');
        }
        $post->views = 0;
        $post->summary = $request->input('summary'); // mô tả bài viết

        $post->meta_title = $request->input('meta_title'); // thẻ meta_title
        $post->meta_description = $request->input('meta_description'); // thẻ meta_description
        $post->user_id = 0; // tạm thời để mặc định user_id (người tạo) là 0

        $post->is_active = $is_active;
        $post->save();
        // nếu có ảnh thumbnail ở request thì lưu
        if ($request->hasFile('thumbnail')) {
            $fileable = new File();
            // get file
            $file = $request->file('thumbnail');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // đường dẫn upload
            $path_upload = 'uploads/post/';
            // upload file
            $request->file('thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->type = "image";
            $fileable->fileable_id = $post->id;
            $fileable->fileable_type = "App\Post";
            $fileable->save(); // lưu thumbnail vào database
        }

        return $post;
    }

    /**
     * @param Request $request
     * @param $id
     * @return |null
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        $post = Post::findOrFail($id);

        if(is_null($post)) {
            return null;
        }
        $is_active = 0;
        if ($request->has('is_active')) { // Kiểm tra xem is_active có tồn tại không?
            $is_active = $request->input('is_active');
        }
        //luu vào csdl
        $post->title = $request->input('title'); // tiêu đề bài viết
        $post->slug = Str::slug($request->input('title'));

        $post->content = $request->input('content'); // nội dung bài viết
        $post->position = $request->input('position'); // vị trí bài viết
        if ($request->has('is_hot')){ // kiểm tra xem có tồn tại key is_hot không?
            $post->is_hot = $request->input('is_hot');
        }
        $post->summary = $request->input('summary'); // mô tả bài viết
        $post->meta_title = $request->input('meta_title'); // thẻ meta_title
        $post->meta_description = $request->input('meta_description'); // thẻ meta_description
        $post->is_active = $is_active;
        $post->save();
        if ($request->hasFile('new_thumbnail')) {

            $fileable = $post->thumbnail;
            \Illuminate\Support\Facades\File::delete($fileable->url); // xóa file thumbnail trước đó
            // get file
            $file = $request->file('new_thumbnail');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // đường dẫn upload
            $path_upload = 'uploads/post/';
            // upload file
            $request->file('new_thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->save(); // lưu thumbnail mới vào database
        }
        return $post;
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $post = Post::findOrFail($id);
        if(is_null($post)) {
            return null;
        }
        $thumbnail = $post->thumbnail;
        \Illuminate\Support\Facades\File::delete($thumbnail->url); // xóa ảnh thumbnail trong folder upload
        $thumbnail->delete();
        $post->delete();

        return true;
    }

    /**
     * @param $tag_id
     * @return |null
     */
    public function filterByTag($tag_id)
    {
        // TODO: Implement filterByTag() method.
        $tag = Tag::findOrFail($tag_id);
        if(is_null($tag)) {
            return null;
        }
        $result = $tag->morphByPosts;
        return $result;
    }

    /**
     * @param $summary
     * @return mixed
     */
    public function searchBySummary($summary)
    {
        // TODO: Implement searchBySummary() method.
        $result = $this->model->where('summary', 'like', '%' . $summary . '%')->get();
        return $result;
    }
}
