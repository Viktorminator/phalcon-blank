<?php
/**
 * Created by Artdevue.
 * User: artdevue - index.php
 * Date: 25.02.17
 * Time: 15:46
 * Project: phalcon-blank
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('PHALCONSTART', microtime(true));
define('PROJECT_PATH', dirname(dirname(__FILE__)) . '/');

use Phalcon\Mvc\Application,
    Phalcon\Loader;

require_once PROJECT_PATH . 'apps/bootstrap.php';

try {
    $loader = new Loader();

    $loader->registerNamespaces([
        'Apps\Commons\Models' => PROJECT_PATH . 'apps/commons/models/',
        'Library'             => PROJECT_PATH . 'library/'
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

    foreach ($config->modules as $index => $modul) {
        $modules[$index] = [
            'className' => $modul->className,
            'path'      => $modul->dir . 'Module.php'
        ];
    }
    $application->registerModules($modules);

    //echo $application->handle()->getContent();
    $response = $application->handle();
    $response->send();

} catch (Exception $e) {
    if ($config->debug) {
        echo get_class($e), ": ", $e->getMessage(), "\n";
        echo " File=", $e->getFile(), "\n";
        echo " Line=", $e->getLine(), "\n";
        echo $e->getTraceAsString();
    } else {
        echo 'Unknown Error';
        die;
    }
}