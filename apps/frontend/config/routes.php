<?php
/**
 * Created by Artdevue.
 * User: artdevue - routes.php
 * Date: 25.02.17
 * Time: 17:44
 * Project: phalcon-blank
 */

$route->add('/', [
    'controller' => 'index',
    'action'     => 'index'
])->setName('frontend.index');

//$router->addResource("Products", "/products");