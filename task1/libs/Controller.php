<?php


class Controller
{
	private $model;

	public function __construct()
	{
		if (isset($_POST))
		{

			$this->sendRequest();
		}
		else
		{
			$this->defaultPage();
		}
	}

	private function sendRequest()
	{
		$model = new Model();
		
		$model->sendRequestCelsius();
		$celsius = $model->getCelsius();
		
		$model->sendRequestCountry();
		$country = $model->getCountry();

		$this->view = new View(TEMPLATE_RESULT);

	}

	private function defaultPage()
	{
		$this->view = new View(DEFAULT_TEMPLATE);

	}
}