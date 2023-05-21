<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Repository
{
    /**
     * @var Model
     */
    public Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        return $this->model->all();
    }


    public function get()
    {
        return $this->model->get();
    }


    public function find($id)
    {
        return $this->model->findOrFail($id);
    }


    public function delete($id): mixed
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function create(array $data = null)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data = null)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function paginate($per_page = null)
    {
        return $this->model->paginate($per_page);
    }

}
