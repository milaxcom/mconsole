<?php

namespace Milax\Mconsole\Contracts;

interface Repository
{
    /**
     * Get model query
     * 
     * @return Builder
     */
    public function query();
    
    /**
     * Create new model instance
     * 
     * @return mixed
     */
    public function factory($attributes = []);
    
    /**
     * Get query for listing page
     * 
     * @return Builder
     */
    public function index();
    
    /**
     * Get objects
     * 
     * @return Collection
     */
    public function get();
    
    /**
     * Find by ID
     * 
     * @param   $id [Object id]
     * @return mixed [Model instance]
     */
    public function find($id);
    
    /**
     * Insert a set of objects
     * 
     * @return mixed
     */
    public function insert($data);
    
    /**
     * Store new object
     *
     * @param  array $data [Data]
     * @return Object
     */
    public function create($data);
    
    /**
     * Update object
     * 
     * @param  int $id   [Object id]
     * @param  array $data [Data]
     * @return Object
     */
    public function update($id, $data);
    
    /**
     * Destroy a set of objects
     * 
     * @param  int $id [Object id]
     * @return mixed
     */
    public function destroy($id);
}
