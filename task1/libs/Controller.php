<?php

include_once 'Model.php';
include_once 'View.php';

class Controller
{
	private $inData;
	private $view;

	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
		$this->view = new View();

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$this->inData = json_decode($_POST['json'],true);

			$this->sendRequest($this->inData);
		}
		else
		{
			$this->defaultPage();
		}
	}


	private function defaultPage()
	{

		$this->view->renderView(DEFAULT_TPL);
	}


	private function sendRequest($data)
	{
		$model = new Model();

		$dataset['celsius'] = $model->sendRequestCelsius($data);

		$dataset['country'] = $model->sendRequestCountry($data);

		if ($model->getError())
		{
			$dataset['error'] = $model->getError();
		}

		$this->view->renderView(JSON_SEND_TPL, $dataset);
	}
}