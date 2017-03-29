<?php

namespace Milax\Mconsole\API;

class SitemapManager
{
    protected $stack = [];
    
    public function register($handler)
    {
        array_push($this->stack, $handler);
        return $this;
    }

    public function setHandler(\Milax\Mconsole\Contracts\Components\SitemapHandler $handler)
    {
        $this->handler = $handler;
    }

    public function handle()
    {
        return $this->handler->handle($this->stack);
    }
}