<?php


class Controller
{
	private $model;

	public function __construct()
	{
		$this->model = new Model();


		if (isset($_POST))
		{

			$this->sendRequest();
		}
		else
		{
			$this->defaultPage();
		}

		$this->view->templateRender();
	}

	private function sendRequest()
	{
		$this->model->sendRequest();

		$this->view = new View(TEMPLATE_RESULT);

		$mArray = $this->model->getArray();

		$this->view->addToReplace($mArray);
	}

	private function defaultPage()
	{
		$this->view = new View(DEFAULT_TEMPLATE);

	}
}