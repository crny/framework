<?php 

namespace Clear\Facades;

use Clear\Support\Container;

abstract class Facade {

    /**
     * DI容器
     *
     * @var \Clear\Support\Container
     */
    protected static $container;

    /**
     * 方法别名
     *
     * <pre>
     * 在子类中使用：
     * protected static $methodAlias = [
     *   //别名 => 原名
     *   'filter' => 'sanitize',
     * ];
     * </pre>
     *
     * @var array
     */
    protected static $methodAlias = [];

    /**
     * 已经实例化的服务
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * 获取服务实例
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new \RuntimeException("Facade does not implement getFacadeAccessor method.");
    }

    /**
     * 生成服务实例
     *
     * @param  string  $name
     * 
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) return $name;

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        return static::$resolvedInstance[$name] = static::$container[$name];
    }

    /**
     * 删除指定实例
     *
     * @param string $name
     * 
     * @return void
     */
    public static function clearResolvedInstance($name)
    {
        unset(static::$resolvedInstance[$name]);
    }

    /**
     * 删除所有实例
     *
     * @return void
     */
    public static function clearResolvedInstances()
    {
        static::$resolvedInstance = array();
    }

    /**
     * 获取DI容器
     *
     * @return \Clear\Support\Container
     */
    public static function getFacadeApplication()
    {
        return static::$container;
    }

    /**
     * 设置DI容器
     *
     * @param \Clear\Support\Container $container
     * 
     * @return void
     */
    public static function setFacadeApplication($container)
    {
        static::$container = $container;
    }

    /**
     * 静态代理
     *
     * @param string $method
     * @param array  $args
     * 
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (method_exists(__CLASS__, $method)) {
            return forward_static_call_array(array(__CLASS__, $method), $args);
        }

        if (isset(static::$methodAlias, $method)) {
            $method = static::$methodAlias[$method];
        }

        switch (count($args))
        {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

}
