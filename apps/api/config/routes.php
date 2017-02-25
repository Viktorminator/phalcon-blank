<?php
/**
 * Created by Artdevue.
 * User: artdevue - routes.php
 * Date: 25.02.17
 * Time: 17:46
 * Project: phalcon-blank
 */

use Phalcon\Mvc\Router\Group as RouterGroup;

/* @var Phalcon\Mvc\Router $router */

// Create a group with a api module and controller
$api = new RouterGroup(
    [
        "module" => "api"
    ]
);

// All the routes start with /api
$api->setPrefix("/api");

$api->add('', [
    'controller' => 'index',
    'action'     => 'index'
])->setName('api-index');

// Add the group to the router
$router->mount($api);