<?php

namespace Milax\Mconsole\Models;

use Illuminate\Database\Eloquent\Model;

class MconsoleOption extends Model
{
    use \Cacheable;
    
    /**
     * Get option value by its key
     * 
     * @param  string $key
     * @return mixed
     */
    public static function getByKey($key)
    {
        if ($cached = self::getCached()->where('key', $key)->first()) {
            return $cached->value;
        } else {
            return null;
        }
    }
}
