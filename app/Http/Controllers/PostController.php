<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepo;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepo
     */
    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->postRepo->getAll();

        return response()->json([
            'products' => $products
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
        $post = $this->postRepo->store($request);

        return response()->json([
            'status' => true,
            'post' => $post
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
        $post = $this->postRepo->find($id);

        return response()->json([
            'post' => $post
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
        // No validation
        $post = $this->postRepo->update($request, $id);
        if(is_null($post)) {
            return response()->json([
                'status' => false,
                'message' => 'Update failed'
            ]);
        }
        return response()->json([
            'status' => 'successfully edited',
            '$post' => $post
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
        $this->postRepo->delete($id);
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
        $result = $this->postRepo->filterByTitle($title);
        if(count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy post phù hợp'
            ]);
        }
        return response()->json([
            'post' => $result
        ]);
    }

    /**
     * @param $tag_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByTag($tag_id)
    {
        $result = $this->postRepo->filterByTag($tag_id);
        if(is_null($result) || count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy post'
            ]);
        }
        return response()->json([
            'post' => $result
        ]);
    }

    /**
     * @param $summary
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchBySummary($summary)
    {
        $result = $this->postRepo->searchBySummary($summary);
        if(is_null($result) || count($result)==0) {
            return response()->json([
                'msg' => 'Không tìm thấy post'
            ]);
        }
        return response()->json([
            'post' => $result
        ]);
    }
}
