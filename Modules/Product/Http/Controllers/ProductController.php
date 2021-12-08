<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\IProductRepository;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(IProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $product = Product::find(1);
        $thumbnail = $product->thumbnail;
        dd($thumbnail);
        dd("Product index");
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $product = $this->productRepo->store($request);

        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $product = $this->productRepo->find($id);
        if(is_null($product)) {
            return response()->json([
                'status' => false,
                'msg' => 'Product not found'
            ]);
        }
        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
//        return json_encode($request->input('name'));
        $product = $this->productRepo->update($request, $id);
        if(is_null($product)) {
            return response()->json([
                'status' => false,
                'msg' => 'Product not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = $this->productRepo->delete($id);
        if(is_null($result)) {
            return response()->json([
                'status' => false,
                'msg' => 'Invalid id or can not find product'
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'Successfully deleted product'
        ]);
    }
}
