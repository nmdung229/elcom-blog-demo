<?php
namespace Modules\Product\Repository;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface IProductRepository extends RepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id);
    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

}
