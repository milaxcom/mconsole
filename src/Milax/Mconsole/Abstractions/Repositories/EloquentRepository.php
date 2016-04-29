<?php

namespace Milax\Mconsole\Abstractions\Repositories;

use Milax\Mconsole\Contracts\Repository;

/**
 * Repository abstract class for module models
 */
abstract class EloquentRepository implements Repository
{
    public $model;
    
    public function __construct($model)
    {
        $this->model = $model;
        $this->query = $model::query();
    }
    
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }
    
    public function query()
    {
        return $this->query;
    }
    
    public function index()
    {
        return $this->query();
    }
    
    public function get()
    {
        $model = $this->model;
        return $model::get();
    }
    
    public function find($id)
    {
        $model = $this->model;
        return $model::findOrFail($id);
    }
    
    public function insert($data)
    {
        $model = $this->model;
        return $model::insert($data);
    }
    
    public function create($data)
    {
        $model = $this->model;
        return $model::create($data);
    }
    
    public function update($id, $data)
    {
        $model = $this->model;
        return $model::findOrFail((int) $id)->update($data);
    }
    
    public function destroy($id)
    {
        $model = $this->model;
        return $model::destroy($id);
    }
}
