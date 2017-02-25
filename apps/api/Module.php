<?php namespace Apps\Api;

use Phalcon\Mvc\View,
    Phalcon\Mvc\View\Engine\Volt;

use Apps\Commons\AbstractModule,
    Phalcon\DiInterface;

/**
 * Created by Artdevue.
 * User: artdevue - Module.php
 * Date: 25.02.17
 * Time: 16:41
 * Project: phalcon-blank
 *
 * Class Module  */
class Module extends AbstractModule
{
    function __construct()
    {
        $this->module    = 'Api';
        $this->namespace = __NAMESPACE__;
        $this->path      = __DIR__;
    }

    /**
     * Registers the module-only services
     */
    public function registerModuleServices(DiInterface $di)
    {
        parent::registerModuleServices($di);
    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {
        parent::registerViewService($di);
    }
}