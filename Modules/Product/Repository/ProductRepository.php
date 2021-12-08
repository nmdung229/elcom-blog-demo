<?php

namespace Modules\Product\Repository;

use App\File;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \Modules\Product\Entities\Product::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $product = Product::findOrFail($id);
        if(is_null($product)) {
            return null;
        }
        return $product;
    }

    /**
     * @param Request $request
     * @return mixed|Product
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
        $product = new Product();
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        if ($request->hasFile('thumbnail')) {
            $fileable = new File();
            // get file
            $file = $request->file('thumbnail');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // đường dẫn upload
            $path_upload = 'uploads/product/';
            // upload file
            $request->file('thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->type = "image";
            $fileable->fileable_id = $product->id;
            $fileable->fileable_type = "Modules\Product\Entities\Product";
            $fileable->save(); // lưu thumbnail vào database
        }

        return $product;
    }
    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        $product = Product::findOrFail($id);
        if(is_null($product))
        {
            return null;
        }
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();
        if ($request->hasFile('new_thumbnail')) {
            $fileable = $product->thumbnail;
            \Illuminate\Support\Facades\File::delete($fileable->url);
            // get file
            $file = $request->file('new_thumbnail');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/product/';
            // upload file
            $request->file('new_thumbnail')->move($path_upload,$filename);
            $fileable->url = $path_upload.$filename;
            $fileable->save();
        }

        return $product;
    }
    public function delete($id)
    {
        // TODO: Implement delete() method.
        if($id < 1) {
            return null;
        }
        $product = Product::findOrFail($id);
        if(is_null($product))
        {
            return null;
        }
        $thumbnail = $product->thumbnail;
        if(!is_null($thumbnail))
        {
            \Illuminate\Support\Facades\File::delete($thumbnail->url);
            $thumbnail->delete();
        }
        $product->delete();

        return true;
    }
}
