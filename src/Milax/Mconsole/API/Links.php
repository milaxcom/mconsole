<?php

namespace Milax\Mconsole\API;

use Milax\Mconsole\Contracts\API\GenericAPI;
use Milax\Mconsole\Contracts\API\RepositoryAPI;
use Milax\Mconsole\Contracts\Repositories\LinksRepository;
use Request;

class Links extends RepositoryAPI implements GenericAPI
{
    public $model = \Milax\Mconsole\Models\Link::class;
    
    /**
     * Create new instance
     */
    public function __construct(LinksRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Sync or detach links
     * 
     * @param  mixed $instance [Related object instance]
     * @return void
     */
    public function sync($instance)
    {
        $model = $this->model;
        
        $sync = [];
        
        if ($links = Request::input('links')) {
            foreach (json_decode($links, true) as $link) {
                if (isset($link['id']) && strlen($link['id']) > 0) {
                    $this->repository->update($link['id'], $link);
                    array_push($sync, $link['id']);
                } else {
                    array_push($sync, $this->repository->create($link)->id);
                }
            }
        }
        
        // dd($sync);

        $instance->links()->sync($sync);
    }
    
    /**
     * Detach all links
     *
     * @param mixed $instance [Linkable object]
     * @return mixed
     */
    public function detach($instance)
    {
        return $instance->links()->detach();
    }
    
    /**
     * Get grouped sets of links
     * 
     * @return void
     */
    public function getGroupedSets()
    {
        return \Milax\Mconsole\Models\Linkable::groupBy(['id', 'linkable_id', 'linkable_type'])->get();
    }
}
