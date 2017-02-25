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
    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {
        /**
         * Register Volt Engine
         */
        $this->di['volt'] = function ($view, $di) {
            $volt = new Volt($view, $di);

            $volt->setOptions([
                'compiledPath'      => PROJECT_PATH . 'apps/frontend/cache/volt',
                'compiledSeparator' => '_'
            ]);

            $volt->getCompiler()->addFilter('hash', 'md5');
            $volt->getCompiler()->addFunction('strtotime', 'strtotime');

            return $volt;
        };

        /**
         * Register View Service
         */
        $this->di['view'] = function () {
            $view = new View();

            $view->setViewsDir(PROJECT_PATH . 'apps/frontend/views/');

            $view->registerEngines([
                '.volt'  => 'volt',
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
                '.php'   => 'Phalcon\Mvc\View\Engine\Php'
            ]);

            return $view;
        };

        /**
         * Register Simple View Service
         */
        $this->di['viewSimple'] = function () {
            $view = new SimpleView;

            $view->setViewsDir($this->config->application->viewsDir);

            return $view;
        };
    }
}