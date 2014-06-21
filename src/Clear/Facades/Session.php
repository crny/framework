<?php 

namespace Clear\Facades;

class Session extends Facade {

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'session'; }

}