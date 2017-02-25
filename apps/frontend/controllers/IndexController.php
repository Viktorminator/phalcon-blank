<?php
/**
 * Created by Artdevue.
 * User: artdevue - IndexController.php
 * Date: 25.02.17
 * Time: 18:43
 * Project: phalcon-blank
 *
 * Class IndexController  * @package Apps\Frontend\Controllers
 */

namespace Apps\Frontend\Controllers;

use Phalcon\Mvc\View;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {

    }

    public function route404Action()
    {
        die("error front");
    }
}