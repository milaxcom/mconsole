<?php

namespace Milax\Mconsole\Menu;

use Milax\Mconsole\Contracts\Menu;
use Milax\Mconsole\Menu\FileMenu;
use Milax\Mconsole\Menu\DatabaseMenu;

class MultiMenu implements Menu
{
    protected $db;
    protected $file;
    
    public function __construct(DatabaseMenu $db, FileMenu $file)
    {
        $this->db = $db;
        $this->file = $file;
    }
    
    /**
     * Load merged DatabaseMenu with FileMenu
     * 
     * @return Illuminate\Support\Collection
     */
    public function load()
    {
        return $this->db->load()->merge($this->file->load());
    }
}
