<?php 

namespace Clear\Facades;

class Router extends Facade {

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'router'; }

}