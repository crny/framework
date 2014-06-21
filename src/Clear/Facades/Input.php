<?php 

namespace Clear\Facades;

class Input extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'request'; }

}