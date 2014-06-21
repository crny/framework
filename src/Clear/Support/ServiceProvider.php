<?php 

namespace Clear\Support;

use ReflectionClass;
use Clear\Support\Container;

abstract class ServiceProvider {

    /**
     * The application instance.
     *
     * @var \Clear\Support\Container
     */
    protected $container;

    /**
     * Create a new service provider instance.
     *
     * @param  \Clear\Support\Container $container
     * 
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register();
}