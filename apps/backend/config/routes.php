<?php
/**
 * Created by Artdevue.
 * User: artdevue - routes.php
 * Date: 25.02.17
 * Time: 17:45
 * Project: phalcon-blank
 */

/*$route->add('/:params', [
    'controller' => 'index',
    'action'     => 'index',
    'params'     => 1
]);

$route->add('/:controller/:params', [
    'controller' => 1,
    'action'     => 'index',
    'params'     => 2
]);

$route->add('/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3
]);*/

$route->add($home_slesh, [
    'controller' => 'index',
    'action'     => 'index'
])->setName('backend.index');

$route->add('/login', [
    'controller' => 'index',
    'action'     => 'login'
])->setName('backend.login');