<?php
/**
 * Created by Artdevue.
 * User: artdevue - ControllerBase.php
 * Date: 25.02.17
 * Time: 17:02
 * Project: phalcon-blank
 *
 * Class ControllerBase  * @package Apps\Api\Controllers
 */

namespace Apps\Api\Controllers;

use Phalcon\Mvc\Controller;

use Phalcon\Mvc\View,
    Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    /**
     * Triggered before executing the controller/action method. At this point the dispatcher has been initialized
     * the controller and know if the action exist.
     *
     * @param Dispatcher $dispatcher
     *
     * @Triggered on Listeners/Controllers
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

    }

    /**
     * Function Onconstruct
     */
    public function onconstruct()
    {

    }

    /**
     * Allow to globally initialize the controller in the request
     *
     * @Triggered on Controllers
     */
    public function initialize()
    {

    }

    /**
     * Triggered after executing the controller/action method. As operation cannot be stopped, only use this event
     * to make clean up after execute the action
     *
     * @param $dispatcher
     *
     * @Triggered on Listeners/Controllers
     */
    public function afterExecuteRoute($dispatcher)
    {

    }
}