<?php 

namespace Clear\Facades;

/**
 * @see \Clear\Facades\Application
 */
class View extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'view'; }
    
}