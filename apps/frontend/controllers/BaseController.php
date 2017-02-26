<?php
/**
 * Created by Artdevue.
 * User: artdevue - BaseController.php
 * Date: 25.02.17
 * Time: 17:01
 * Project: phalcon-blank
 *
 * Class ControllerBase  * @package Apps\Frontend\Controllers
 */

namespace Apps\Frontend\Controllers;

use Phalcon\Mvc\Controller;

use Phalcon\Mvc\View,
    Phalcon\Mvc\Dispatcher;

class BaseController extends Controller
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

    public function route404Action()
    {
        // Shows only the view related to the action
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );

        return $this->view->pick("error404");
    }
}