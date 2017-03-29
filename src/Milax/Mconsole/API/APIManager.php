<?php

namespace Milax\Mconsole\API;

use Milax\Mconsole\Exceptions\APINamespaceExistsException;

/**
 * Class for serving mconsole API services
 */
class APIManager
{
    /**
     * Register an API class
     * 
     * @param  string $namespace [API namespace]
     * @param  mixed $instance  [API class instance]
     * @param  bool $force  [Ignore existing instance]
     * @return $this
     */
    public function register($namespace, $instance, $force = false)
    {
        if (str_contains($namespace, '.')) {
            $namespaces = explode('.', $namespace);
            $namespace = array_pull($namespaces, 0);
            $namespaces = implode('.', $namespaces);
            
            if (!property_exists($this, $namespace)) {
                $this->$namespace = [];
            }
            
            if (array_get($this->$namespace, $namespaces) && !$force) {
                throw new APINamespaceExistsException(sprintf('The namespace "%s" is already registered in API, unable to register', $namespace));
            }
            
            array_set($this->$namespace, $namespaces, $instance);
        } else {
            if (property_exists($this, $namespace) && !$force) {
                throw new APINamespaceExistsException(sprintf('The namespace "%s" is already registered in API, unable to register', $namespace));
            }
            $this->$namespace = $instance;
        }

        return $this;
    }

    /**
     * Replace an API class
     * 
     * @param  string $namespace [API namespace]
     * @param  mixed $instance  [API class instance]
     * @return $this
     */
    public function replace($namespace, $instance)
    {
        return $this->replace($namespace, $instance, true);
    }
}
