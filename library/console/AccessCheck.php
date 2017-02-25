<?php namespace Console;

use Library\Auth\Auth;

class AccessCheck implements AccessInterface, \Phalcon\DI\InjectionAwareInterface
{
    protected $di;

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $di
     */
    public function setDI($di)
    {
        $this->di = $di;
    }

    public function check() {
        $config = $this->di['console.config'];

        /** @var Auth $auth */
        $auth = $this->di['auth'];

        if ($auth->getUser() && $auth->getUser()->isAdmin())
        {
            return true;
        }

        $filter = $config->filter;
        $ips = $config->$filter->toArray();
        $ip = $this->di['request']->getClientAddress();

        if ($filter == $config->whitelist && in_array($ip, $ips))
        {
            return true;
        }
        else if ($filter == $config->blacklist && ! in_array($ip, $ips))
        {
            return true;
        }

        return false;
    }

}
