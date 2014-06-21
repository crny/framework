<?php 

namespace Clear\Facades;

class Filter extends Facade {

    protected static $methodAlias = [
        'filter' => 'sanitize',
    ];

    /**
     * 获取在container中注入的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'filter'; }


}