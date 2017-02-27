<?php namespace Apps\Api;

use Phalcon\Mvc\View;
use Apps\Commons\AbstractModule,
    Phalcon\DiInterface,
    Phalcon\Mvc\Dispatcher;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

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
     * Registers the module-only services
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices(DiInterface $di = null)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setDI($di);
        $dispatcher->setDefaultNamespace('Apps\Api\Controllers');

        $eventsManager = new \Phalcon\Events\Manager();
        $eventsManager->attach('dispatch:beforeException', function ($event, $dispatcher, $exception) use (&$di) {
            //error_log('dispatch:beforeException');
            $dispatcher->setParam('exception',$exception);
            $dispatcher->forward(
                [
                    'module'     => 'api',
                    'controller' => 'base',
                    'action'     => 'exception',
                    'error'      => $exception
                ]
            );

            return false;
        });

        $dispatcher->setEventsManager($eventsManager);

        $di->set('dispatcher', $dispatcher);

        /**
         * @var \Phalcon\Http\ResponseInterface $response
         */
        $response = $di->get('response');
        $response->setHeader('Access-Control-Allow-Origin', '*')
            ->setContentType('application/json', 'utf-8');

        // This component makes use of adapters to store the logged messages.
        $di->setShared('logger', function ()
        {
            return new FileAdapter(PROJECT_PATH . "apps/logs/api.log");
        });
    }

    /**
     * Registers module View Service
     */
    protected function registerViewService(DiInterface $di)
    {

        //parent::registerViewService($di);

        $this->di['view'] = function () {

            $view = new View();
            // Disable the view to avoid rendering
            $view->disable();

            return $view;
        };
    }
}