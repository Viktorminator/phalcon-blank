<?php

/*
|--------------------------------------------------------------------------
| Error handler
|--------------------------------------------------------------------------
*/

/*App::error(function (Exception $e, $code) {
	if (Route::currentRouteName() !== 'console_execute') {
		return;
	}
	ob_end_clean();
	Console::addProfile('error', array(
		'type'    => $code,
		'message' => $e->getMessage(),
		'file'    => $e->getFile(),
		'line'    => $e->getLine(),
	));
	return Response::json(Console::getProfile(), 200);
});*/

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

$router->addGet('/phalcon-console', [
    'module'     => null,
    'namespace'  => 'Console\Controller',
    'controller' => 'Index',
    'action'     => 'index',
])->setName('console');

$router->addPost('/phalcon-console', [
    'module'     => null,
    'namespace'  => 'Console\Controller',
    'controller' => 'Execute',
    'action'     => 'index',
])->setName('console_execute');