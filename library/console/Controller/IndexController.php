<?php namespace Console\Controller;

class IndexController extends ControllerBase
{
	public function indexAction()
	{
		return $this->di['console']->render();
	}

}