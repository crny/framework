<?php 

namespace Clear\Facades;

class Response extends Facade {

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'response'; }

}