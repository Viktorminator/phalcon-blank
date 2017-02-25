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
    Phalcon\Mvc\Dispatcher,
    Phalcon\DiInterface,
    Phalcon\Mvc\View\Engine\Volt,
    Phalcon\Mvc\ModuleDefinitionInterface;

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
        ]);

        $loader->register();

        //$this->registerShared();
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
        /**
         * Read configuration
         */
        $this->config = include $this->path . "/config/config.php";

        $this->di->set('moduleConfig', $this->config, true);
    }

    protected function registerModuleServices(DiInterface $di)
    {
    }

    protected function registerViewService(DiInterface $di)
    {
    }
}