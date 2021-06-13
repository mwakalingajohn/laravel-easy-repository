<?php


namespace Mwakalingajohn\LaravelEasyRepository\Implementations;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Mwakalingajohn\LaravelEasyRepository\Repository;

class Eloquent implements Repository
{
    /**
     * Model object to use in the repository
     */
    protected $model = null;

    public function __construct()
    {
        if ($this->model == null) {
            throw new Exception("Model class is not defined!");
        }
    }

    /**
     * Fin an item by id
     * @param int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * Return all items
     * @return Collection|null
     */
    public function all()
    {
        return $this->model::all();
    }

    /**
     * Return query builder instance to perform more manouvers
     * @return Builder|null
     */
    public function query()
    {
        return $this->model::query();
    }

    /**
     * Create an item
     * @param array|mixed $data
     * @return Model|null
     */
    public function create($data)
    {
        return $this->model::create($data);
    }

    /**
     * Update a model
     * @param int|mixed $id
     * @param array|mixed $data
     * @return bool|mixed
     */
    public function update($id, array $data)
    {
        return $this->model::find($id)->update($data);
    }

    /**
     * Delete a model
     * @param int|Model $id
     */
    public function delete($id)
    {
        return $this->model::destroy($id);
    }
}
