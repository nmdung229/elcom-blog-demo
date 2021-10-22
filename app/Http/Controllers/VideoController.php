<?php

namespace App\Http\Controllers;

use App\Repositories\Video\VideoRepositoryInterface;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoRepo;

    public function __construct(VideoRepositoryInterface $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoRepo->getAll();

        return response()->json([
            'videos' => $videos
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = $this->videoRepo->store($request);

        return response()->json([
            'status' => true,
            'video' => $video
        ]);
    }

    /**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id)
    {
        $video = $this->videoRepo->find($id);

        return response()->json([
            'video' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = $this->videoRepo->update($request, $id);
        if(is_null($video)) {
            return response()->json([
                'status' => false,
                'message' => 'Update failed'
            ]);
        }
        return response()->json([
            'status' => 'successfully edited',
            'video' => $video
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->videoRepo->delete($id);
        return response()->json([
            'status' => true
        ], 200);
    }

    /**
     * @param $title
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByTitle($title)
    {
        $result = $this->videoRepo->filterByTitle($title);
        if(count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy video phù hợp'
            ]);
        }
        return response()->json([
            'video' => $result
        ]);
    }

    /**
     * @param $tag_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByTag($tag_id)
    {
        $result = $this->videoRepo->filterByTag($tag_id);
        if(is_null($result) || count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy video'
            ]);
        }
        return response()->json([
            'video' => $result
        ]);
    }

    public function searchByDescription($description)
    {
        $result = $this->videoRepo->searchByDescription($description);
        if(is_null($result) || count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy video'
            ]);
        }
        return response()->json([
            'video' => $result
        ]);
    }
}
