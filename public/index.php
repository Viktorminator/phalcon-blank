<?php
/**
 * Created by Artdevue.
 * User: artdevue - index.php
 * Date: 25.02.17
 * Time: 15:46
 * Project: phalcon-blank
 */
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

define('PHALCONSTART', microtime(true));
define('PROJECT_PATH', dirname(dirname(__FILE__)) . '/');

use Phalcon\Mvc\Application,
    Phalcon\Loader;

require_once PROJECT_PATH . 'apps/bootstrap.php';

try
{
    $loader = new Loader();

    $loader->registerNamespaces([
        'Apps\Commons\Models' => PROJECT_PATH . 'apps/commons/models/',
        'Library' => PROJECT_PATH . 'library/'
    ]);

    $loader->registerClasses([
        'Apps\Commons\AbstractModule' => PROJECT_PATH . 'apps/commons/AbstractModule.php',
    ]);

    $loader->register();

    /**
     * Include services
     */
    require PROJECT_PATH . 'config/services.php';
    require PROJECT_PATH . 'config/repos.php';

    /**
     * Handle the request
     */
    $application = new Application();

    /**
     * Assign the DI
     *
     * @var Phalcon\DI\FactoryDefault $di
     */
    $application->setDI($di);

    /**
     * Register application modules
     */
    $modules = [];

    foreach ($config->modules as $index => $modul)
    {
        $modules[$index] = [
            'className' => $modul->className,
            'path'      => $modul->dir . 'Module.php'
        ];
    }
    $application->registerModules($modules);

    echo $application->handle()->getContent();
}
catch (Phalcon\Exception $e)
{
    // remove view contents from buffer
    if (ob_get_contents()) ob_end_clean();

    $errorCode = 500;

    $errorView = PROJECT_PATH . 'apps/commons/views/error.phtml';
    die(print_r($e->getMessage(), true));
    switch (true)
    {
        // 401 UNAUTHORIZED
        case $e->getCode() == 401:
            $errorCode = 401;
            break;

        // 403 FORBIDDEN
        case $e->getCode() == 403:
            $errorCode = 403;
            break;

        // 404 NOT FOUND
        case $e->getCode() == 404:
        case ($e instanceof Phalcon\Mvc\View\Exception):
        case ($e instanceof Phalcon\Mvc\Dispatcher\Exception):
        case ($e instanceof Phalcon\DI\Exception):
            $errorCode = 404;
            break;
    }

    // Get error view contents. Since we are including the view
    // file here you can use PHP and local vars inside the error view.
    ob_start();
    include_once $errorView;
    $contents = ob_get_contents();
    ob_end_clean();

    // send view to header
    $di->getShared('response')
        ->resetHeaders()
        ->setStatusCode($errorCode, null)
        ->setContent($contents)
        ->send();
}
catch (Exception $e)
{
    if ($config->debug)
    {
        echo $e->getMessage();
    }
    else
    {
        echo 'Unknown Error';
        die;
    }
}