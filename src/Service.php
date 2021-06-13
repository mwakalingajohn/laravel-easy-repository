<?php

namespace Mwakalingajohn\LaravelEasyRepository;

use Exception;

class Service
{
    /**
     * Repository object to perform CRUD fuctionalities. It is required in the
     * base Service class
     * @property Repository $repository;
     */
    protected Repository $repository;

    /**
     * The repository interface to use in this service. Will allow to use within
     * methods $this->repository. It will be resolved from the container
     * @property string $repositoryInterface;
     */
    protected string $repositoryInterface = "";

    public function __construct()
    {
        $this->initialiseRepository();
    }

    /**
     * Find an item by id
     * @param int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Return all items
     * @return Collection|null
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Return query builder instance to perform more manouvers
     * @return Builder|null
     */
    public function query()
    {
        return $this->repository->query();
    }

    /**
     * Create an item
     * @param array|mixed $data
     * @return Model|null
     */
    public function create($data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update a model
     * @param int|mixed $id
     * @param array|mixed $data
     * @return bool|mixed
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a model
     * @param int|Model $id
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Initialize repository from the container
     * @return Repository|Exception|mixed
     */
    public function initialiseRepository()
    {
        if (
            $this->repositoryInterface == null ||
            ! is_string($this->repositoryInterface) ||
            $this->repositoryInterface == ""
        ) {
            throw new Exception("Please define the repository interface");
        }

        $this->repository = app()->make($this->repositoryInterface);
    }
}
