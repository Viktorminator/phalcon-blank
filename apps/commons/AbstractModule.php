<?php
/**
 * Created by Artdevue.
 * User: artdevue - AbstractModule.php
 * Date: 25.02.17
 * Time: 16:44
 * Project: phalcon-blank
 *
 * Class AbstractModule  * @package Apps\Commons
 */

namespace Apps\Commons;

use Phalcon\Loader,
    Phalcon\Mvc\View,
    Phalcon\DiInterface,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View\Engine\Volt,
    Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

abstract class AbstractModule implements ModuleDefinitionInterface
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;

    /**
     * @var \Phalcon\Config
     */
    protected $config;

    /**
     * @var string Module Name
     */
    protected $module;

    /**
     * @var string Module Namespace
     */
    protected $namespace;

    /**
     * @var string Module Path
     */
    protected $path;

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $this->registerModuleAutoloaders($di);

        $loader = new Loader();

        $loader->registerNamespaces([
            $this->namespace . '\Controllers' => $this->path . '/controllers/',
            $this->namespace . '\Models'      => $this->path . '/models/',
            $this->namespace . '\Form'      => $this->path . '/forms/',
        ]);

        $loader->register();
    }

    /**
     * Register module-only Autoloaders
     */
    protected function registerModuleAutoloaders(DiInterface $di)
    {

    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $this->di = $di;

        $this->registerDispatcher($di);
        $this->registerConfig($di);

        $this->registerViewService($di);
        $this->registerModuleServices($di);
    }

    /**
     * Register module Dispatcher Service
     */
    protected function registerDispatcher(DiInterface $di)
    {
        $namespace              = $this->namespace;
        $this->di['dispatcher'] = function () use ($namespace, $di) {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace($namespace . '\Controllers');
            $dispatcher->setEventsManager($di['eventsManager']);

            return $dispatcher;
        };
    }

    /**
     * Register module Config
     */
    protected function registerConfig(DiInterface $di)
    {
        $this->config = $di->get('config');
        /**
         * Read configuration
         */
        if (file_exists($this->path . "/config/config.php")) {
            $config = include $this->path . "/config/config.php";
            $this->di->set('config', $this->config->merge($config), true);
        }
    }

    protected function registerModuleServices(DiInterface $di)
    {
        $module = $this->module;

        // This component makes use of adapters to store the logged messages.
        $di->setShared('logger', function () use ($module )
        {
            return new FileAdapter(PROJECT_PATH . "apps/logs/' . $module  . '.log");
        });
    }

    protected function registerViewService(DiInterface $di)
    {
        $patch  = $this->path;
        $module = $this->module;

        // We verify the existence of a directory
        if (!file_exists(PROJECT_PATH . '/cache/volt/' . $module)) {
            if (!mkdir(PROJECT_PATH . '/cache/volt/' . $module, 0777, true)) {
                die('Unable to create directory ...');
            }
        }

        /**
         * Register Volt Engine
         */
        $this->di['volt'] = function ($view, $di) use ($module) {
            $volt = new Volt($view, $di);

            $volt->setOptions([
                'compiledPath'      => PROJECT_PATH . '/cache/volt/' . $module . '/',
                'compiledSeparator' => '_'
            ]);

            $volt->getCompiler()->addFilter('hash', 'md5');
            $volt->getCompiler()->addFunction('strtotime', 'strtotime');

            return $volt;
        };

        /**
         * Register View Service
         */
        $this->di['view'] = function () use ($patch, $module) {

            $view = new View();
            $view->setViewsDir($patch . '/views/');

            $view->registerEngines([
                '.volt'  => function ($view, $di) use ($module) {

                    $volt = new Volt($view, $di);

                    $volt->setOptions([
                        'compiledPath'      => PROJECT_PATH . '/cache/volt/' . $module . '/',
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