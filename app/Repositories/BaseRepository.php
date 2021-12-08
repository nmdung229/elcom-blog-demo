<?php
namespace App\Repositories;

use App\Tag;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]|mixed
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
        $result = $this->model->findOrFail($id);

        return $result;
    }

    /**
     * @param $title
     * @return mixed
     */
    public function filterByTitle($title)
    {
        // TODO: Implement filterByTitle() method.
        $result = $this->model->where('title', 'like', '%' . $title . '%')->get();

        return $result;
    }
}
