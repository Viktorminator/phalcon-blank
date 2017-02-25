<?php namespace Apps\Frontend;

use Phalcon\Mvc\View,
    Phalcon\Mvc\View\Simple as SimpleView,
    Phalcon\Mvc\View\Engine\Volt;

use Apps\Commons\AbstractModule,
    Phalcon\DiInterface;
use Phalcon\Queue\Beanstalk;

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
        $this->module    = 'Frontend';
        $this->namespace = __NAMESPACE__;
        $this->path      = __DIR__;
    }

    /**
     * Register Module Autoloaders
     */
    public function registerModuleAutoloaders(DiInterface $di)
    {
        require __DIR__ . '/../../vendor/autoload.php';

        parent::registerModuleAutoloaders($di);
    }

    /**
     * Registers the module-only services
     */
    public function registerModuleServices(DiInterface $di)
    {
        $this->di['queue'] = function () {
            $queue = new Beanstalk();
            $queue->connect();

            return $queue;
        };

        parent::registerModuleServices($di);
    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {
        /**
         * Register Simple View Service
         */
        $this->di['viewSimple'] = function () {
            $view = new SimpleView;

            $view->setViewsDir($this->config->application->viewsDir);

            return $view;
        };

        parent::registerViewService($di);
    }
}