<?php

namespace Milax\Mconsole\Http\Composers;

use Illuminate\View\View;
use Milax\Mconsole\Models\MconsoleMenu;
use Milax\Mconsole\Contracts\Menu;
use Request;

class SectionComposer
{
    public function compose(View $view)
    {
        $route = Request::route()->getName();
        
        $menu = app('API')->menu->get(true)->where('route', $route)->first();
        
        if ($menu) {
            $view->with('pageTitle', trans('mconsole::' . $menu->translation))
                ->with('pageCaption', trans('mconsole::' . $menu->translation));
        }
    }
}
