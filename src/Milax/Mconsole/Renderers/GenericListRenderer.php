<?php

namespace Milax\Mconsole\Renderers;

use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Renderers\FilterableListRenderer;
use Milax\Mconsole\Processors\TableProcessor;
use Illuminate\Database\Eloquent\Builder;
use Milax\Mconsole\Handlers\Filters\GetFilterHandler;
use View;

/**
 * Stardart Mconsole table wrapper
 */
class GenericListRenderer implements ListRenderer
{
    public $query;
    public $perPage = 0;
    public $actions = [
        'add' => false,
        'edit' => true,
        'delete' => true,
    ];
    public $defaultView = 'mconsole::layouts.list';
    public $filterHandler;
    
    protected $processor;
    
    public function __construct(GetFilterHandler $filterHandler, TableProcessor $processor)
    {
        $this->processor = $processor;
        $this->filterHandler = $filterHandler;
    }
    
    public function setAddAction($action)
    {
        $this->actions['add'] = $action;
        return $this;
    }
    
    public function removeAddAction()
    {
        $this->actions['add'] = false;
        return $this;
    }
    
    public function removeEditAction()
    {
        $this->actions['edit'] = false;
        return $this;
    }
    
    public function removeDeleteAction()
    {
        $this->actions['delete'] = false;
        return $this;
    }
    
    public function setText($label, $key, $exact = false)
    {
        return $this->filterHandler->setText($label, $key, $exact);
    }
    
    public function setSelect($label, $key, $selects, $exact = false)
    {
        return $this->filterHandler->setSelect($label, $key, $selects, $exact);
    }
    
    public function setQuery(Builder $query)
    {
        $this->query = $query;
        return $this;
    }
    
    public function render($cb, $view = null)
    {
        $this->query = $this->filterHandler->handleFilterQuery($this->query);
        
        if ($this->perPage > 0) {
            $this->items = $this->query->paginate($this->perPage);
            View::share('paging', $this->items);
        } else {
            $this->items = $this->query->get();
        }
        
        if (!is_null($view) && View::exists($view)) {
            return view($view, [
                'items' => $this->processor->run($cb, $this->items),
            ]);
        } else {
            $addAction = $this->actions['add'] != false ? $this->actions['add'] : null;
            if (!is_null($addAction)) {
                $addAction = (str_contains($addAction, 'mconsole')) ? $addAction : sprintf('/mconsole/%s', trim($addAction, '/'));
            }
            return view($this->defaultView, [
                'tableOptions' => [
                    'items' => $this->processor->run($cb, $this->items),
                    'add' => $addAction,
                    'edit' => $this->actions['edit'],
                    'delete' => $this->actions['delete'],
                ],
            ]);
        }
    }
    
    public function setPerPage($perPage = 20)
    {
        $this->perPage = $perPage;
        return $this;
    }
    
    public function paginate(Builder $query)
    {
        $this->items = $this->query->paginate($this->perPage);
        return $this->items;
    }
}
