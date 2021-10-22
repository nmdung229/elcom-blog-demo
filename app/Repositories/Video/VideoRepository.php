<?php

namespace App\Repositories\Video;

use App\File;
use App\Tag;
use App\Video;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;



class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return  \App\Video::class;
    }

    /**
     * @param Request $request
     * @return Video|mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
        $video = new Video();
        $video->title = $request->input('title'); // tiêu đề
        $video->description = $request->input('description'); // mô tả
        $video->length = $request->input('length'); // độ dài video (second)
        $video->user_upload_id = 0; // tạm thời để user_id (người tạo) là 0
        $video->save();

        // nếu có ảnh thumbnail ở request thì lưu
        if ($request->hasFile('thumbnail')) {
            $fileable = new File();
            // get file
            $file = $request->file('thumbnail');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // đường dẫn upload
            $path_upload = 'uploads/video/';
            // upload file
            $request->file('thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->type = "image";
            $fileable->fileable_id = $video->id;
            $fileable->fileable_type = "App\Video";
            $fileable->save(); // lưu thumbnail vào database
        }

        return $video;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed|null
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        $video = Video::findOrFail($id);
        if(is_null($video))
        {
            return null;
        }

        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->length = $request->input('length');
        $video->user_upload_id = 0; // tam thoi de la 0
        $video->save();

        // nếu có ảnh thumbnail ở request thì lưu
        if ($request->hasFile('new_thumbnail')) {
            $fileable = $video->thumbnail;
            \Illuminate\Support\Facades\File::delete($fileable->url);
            // get file
            $file = $request->file('new_thumbnail');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/video/';
            // upload file
            $request->file('new_thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->save();
        }

        return $video;
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $video = Video::findOrFail($id);
        if(is_null($video)) {
            return null;
        }
        $thumbnail = $video->thumbnail;
        \Illuminate\Support\Facades\File::delete($thumbnail->url);
        $thumbnail->delete();
        $video->delete();

        return true;
    }

    /**
     * @param $tag_id
     * @return mixed|null
     */
    public function filterByTag($tag_id)
    {
        // TODO: Implement filterByTag() method.
        $tag = Tag::find($tag_id);
        if(is_null($tag)) {
            return null;
        }
        $result = $tag->morphByVideos;
        return $result;
    }

    /**
     * @param $description
     * @return mixed
     */
    public function searchByDescription($description)
    {
        // TODO: Implement searchByDescription() method.
        $result = $this->model->where('description', 'like', '%' . $description . '%')->get();
        return $result;
    }
}
