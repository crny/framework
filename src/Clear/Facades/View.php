<?php 

namespace Clear\Facades;

/**
 * @see \Clear\Facades\Application
 */
class View extends Facade {

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'view'; }
    
}