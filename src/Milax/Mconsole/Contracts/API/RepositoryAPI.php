<?php

namespace Milax\Mconsole\Contracts\API;

/**
 * Repository abstract class for APIs that uses Models
 */
abstract class RepositoryAPI
{
    protected $model;
    
    /**
     * Create new instance
     * 
     * @param mixed $model [Eloquent model]
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
    
    /**
     * Get objects
     * 
     * @return Collection
     */
    public function index()
    {
        $model = $this->model;
        return $model::get();
    }
    
    /**
     * Find by ID
     * 
     * @param   $id [Object id]
     * @return mixed [Model instance]
     */
    public function find($id)
    {
        $model = $this->model;
        return $model::find($id);
    }
    
    /**
     * Store new object
     *
     * @param  array $data [Data]
     * @return Object
     */
    public function store($data)
    {
        $model = $this->model;
        return $model::create($data);
    }
    
    /**
     * Update object
     * 
     * @param  int $id   [Object id]
     * @param  array $data [Data]
     * @return Object
     */
    public function update($id, $data)
    {
        $model = $this->model;
        return $model::find((int) $id)->update($data);
    }
    
    /**
     * Destroy object
     * 
     * @param  int $id [Object id]
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model;
        return $model::destroy($id);
    }
}