<?php
namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface PostRepositoryInterface extends RepositoryInterface
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
     * @param $summary
     * @return mixed
     */
    public function searchBySummary($summary);
}
