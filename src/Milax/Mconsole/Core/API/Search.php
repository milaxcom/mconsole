<?php

namespace Milax\Mconsole\Core\API;

use Milax\Mconsole\Contracts\API\ServiceAPI;

class Search implements ServiceAPI
{
    protected $stack = [];
    
    /**
     * Register search engine callback
     * 
     * @param  Closure $callback
     * @return void
     */
    public function register($callback)
    {
        $this->stack[] = $callback;
    }
    
    /**
     * Handle search
     * 
     * @param  string $text
     * @return Illuminate\Support\Collection
     */
    public function handle($text)
    {
        $results = collect();
        foreach ($this->stack as $callback) {
            if ($result = $callback($text)) {
                $results = $results->merge($result);
            }
        }
        return $results;
    }
}
