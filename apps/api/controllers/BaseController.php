<?php
/**
 * Created by Artdevue.
 * User: artdevue - BaseController.php
 * Date: 25.02.17
 * Time: 17:02
 * Project: phalcon-blank
 *
 * Class ControllerBase  * @package Apps\Api\Controllers
 */

namespace Apps\Api\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    /**
     * Allow to globally initialize the controller in the request
     *
     * @Triggered on Controllers
     */
    public function initialize()
    {

    }

    /**
     * @return array
     */
    public function exceptionAction()
    {
        /**
         * @var $exception \Exception
         */
        $exception = $this->di->get('dispatcher')->getParam('exception');

        $message = $exception->getMessage();

        if (empty($message))
        {
            $message = 'Houston we have got a problem';
        }

        if ($this->config->debug == true)
        {
            switch ($exception->getCode())
            {
                case 500:
                    $this->logger->critical((string)$exception);
                    break;
                default:
                    $this->logger->debug((string)$exception);
                    break;
            }
        }
        else
        {
            $this->logger->debug((string)$exception);
            $message = '';
        }

        $this->response->setStatusCode($exception->getCode(), $this->helpers->getHttpStatusMessage($exception->getCode()));

        return [
            'success' => false,
            'status_code' => $exception->getCode() . ' - ' . $this->helpers->getHttpStatusMessage($exception->getCode()),
            'message' => $message
        ];
    }

    /**
     * @return array
     */
    public function route404Action()
    {
        $this->response->setStatusCode(404, 'Not found');
        $this->logger->debug('Error to handle: ' . $this->request->getURI());

        return [
            'success' => false,
            'status_code' => '404 - Not Found',
            'url' => $this->request->getURI(),
            'parameters' => $this->dispatcher->getParams()
        ];
    }
}