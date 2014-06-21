<?php 

namespace Clear\Facades;

class Filter extends Facade {

    protected static $methodAlias = [
        'filter' => 'sanitize',
    ];

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'filter'; }


}