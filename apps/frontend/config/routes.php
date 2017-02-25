<?php
/**
 * Created by Artdevue.
 * User: artdevue - routes.php
 * Date: 25.02.17
 * Time: 17:44
 * Project: phalcon-blank
 */

use Phalcon\Mvc\Router\Group as RouterGroup;

/* @var Phalcon\Mvc\Router $router */

// Create a group with a frontend module and controller
$front = new RouterGroup(
    [
        "module" => "frontend"
    ]
);

$front->add('/', [
    'controller' => 'index',
    'action'     => 'index'
])->setName('front-home');

// Add the group to the router
$router->mount($front);