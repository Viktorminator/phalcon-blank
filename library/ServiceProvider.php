<?php
/**
 * Created by Artdevue.
 * User: artdevue - ServiceProvider.php
 * Date: 25.02.17
 * Time: 15:44
 * Project: phalcon-blank
 *
 * Class ServiceProvider
 * @package Apps
 */

namespace Library;


abstract class ServiceProvider
{
    /**
     * The application instance.
     *
     * @var \Phalcon\DI\FactoryDefault
     */
    protected $app;

    /**
     * Create a new service provider instance.
     *
     * @param  \Phalcon\DI\FactoryDefault $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register();
}