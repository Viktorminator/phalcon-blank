<?php
/**
 * Created by Artdevue.
 * User: artdevue - cli.php
 * Date: 26.02.17
 * Time: 04:46
 * Project: phalcon-blank
 */

date_default_timezone_set('US/Eastern');

use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Loader;

define('VERSION', '1.0.0');
define('PROJECT_PATH', dirname(dirname(__FILE__)) . '/');

// Using the CLI factory default services container
$di = new CliDI();

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__)));

// Define path to application directory
defined('CORE_PATH')
|| define('CORE_PATH', realpath(dirname(dirname(__FILE__))));

/**
 * Register the autoloader and tell it to register the tasks directory
 */
$loader = new Loader();
$loader->registerDirs(
    array(
        APPLICATION_PATH . '/tasks',
        APPLICATION_PATH . '/tasks/models',
        CORE_PATH . '/library'
    )
);
$loader->register();

// Load the configuration file (if any)
$config = include_once CORE_PATH . '/config/config.php';

/**
 * Register the global configuration as config
 */
$di->set('config', $config);

//Setup the database service
$di->set('db', function() use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ));
});

// Create a console application
$console = new ConsoleApp();
$console->setDI($di);

/**
 * Process the console arguments
 */
$arguments = array();
foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

// Define global constants for the current task and action
define('CURRENT_TASK',   (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
    // Handle incoming arguments
    $console->handle($arguments);
} catch (\Phalcon\Exception $e)
{
    echo $e->getMessage();
    exit(255);
}