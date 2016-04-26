<?php 

namespace Milax\Mconsole\Traits\Controllers;

trait DoesNotHaveShow
{
    /**
     * Provides the show method for resource controllers
     * 
     * @param  int $id [Instance id]
     * @return Redirector
     */
    public function show($id) {
        $route = str_replace('show', 'index', \Request::route()->getName());
        return redirect()->route($route);
    }
}