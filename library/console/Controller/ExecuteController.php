<?php namespace Console\Controller;

class ExecuteController extends ControllerBase
{
    protected $restful = true;

	public function indexAction()
	{
		$code = $this->request->getPost('code');

		// Execute and profile the code
		$profile = $this->di['console']->execute($code);

		// Response
		return $profile;
	}

}