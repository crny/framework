<?php 

namespace Clear\Support;

use ReflectionClass;
use Clear\Support\Container;

abstract class ServiceProvider {

    /**
     * DI容器
     *
     * @var \Clear\Support\Container
     */
    protected $container;

    /**
     * 实例化容器
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
     * 注册服务
     *
     * @return void
     */
    abstract public function register();
}