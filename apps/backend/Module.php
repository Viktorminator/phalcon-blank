<?php namespace Apps\Backend;

use Phalcon\Mvc\View,
    Phalcon\Mvc\View\Engine\Volt;

use Apps\Commons\AbstractModule,
    Phalcon\DiInterface;

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

    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {
        $this->di['view'] = function () {

            $view = new View();
            $view->setViewsDir(PROJECT_PATH . 'apps/backend/views/');

            $view->registerEngines([
                '.volt'  => function ($view, $di) {

                    $volt = new Volt($view, $di);

                    $volt->setOptions([
                        'compiledPath'      => PROJECT_PATH . 'apps/backend/cache/volt',
                        'compiledSeparator' => '_'
                    ]);

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
                '.php'   => 'Phalcon\Mvc\View\Engine\Php'
            ]);

            return $view;
        };
    }
}