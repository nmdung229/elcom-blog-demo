<?php
namespace App\Repositories\Video;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface VideoRepositoryInterface extends RepositoryInterface
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

    /**
     * @param $tag_id
     * @return mixed
     */
    public function filterByTag($tag_id);

    /**
     * @param $description
     * @return mixed
     */
    public function searchByDescription($description);
}
