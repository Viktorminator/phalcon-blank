<?php namespace Apps\Backend;

use Apps\Commons\AbstractModule,
    Phalcon\DiInterface;

use Phalcon\Mvc\Dispatcher as MvcDispatcher;

/**
 * Created by Artdevue.
 * User: artdevue - Module.php
 * Date: 25.02.17
 * Time: 16:40
 * Project: phalcon-blank
 *
 * Class Module  */
class Module extends AbstractModule
{
    function __construct()
    {
        $this->module    = 'Backend';
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

    protected function registerService(DiInterface $di)
    {
        parent::registerServices($di);
    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {
        parent::registerViewService($di);
    }
}