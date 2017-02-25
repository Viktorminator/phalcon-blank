<?php
/**
 * Created by Artdevue.
 * User: artdevue - routes.php
 * Date: 25.02.17
 * Time: 17:45
 * Project: phalcon-blank
 */

use Phalcon\Mvc\Router\Group as RouterGroup;

/* @var Phalcon\Mvc\Router $router */

// Create a group with a backend module and controller
$back = new RouterGroup(
    [
        "module" => "backend"
    ]
);

// All the routes start with /admin
$back->setPrefix("/admin");

$back->add('', [
    'controller' => 'index',
    'action'     => 'index'
])->setName('back-index');

// Add the group to the router
$router->mount($back);