<?php
/**
 * Created by Artdevue.
 * User: artdevue - IndexController.php
 * Date: 25.02.17
 * Time: 19:11
 * Project: phalcon-blank
 *
 * Class IndexController  * @package Apps\Api\Controllers
 */

namespace Apps\Api\Controllers;

class IndexController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        throw new \Exception('Just because');
        return 'test';
    }
}