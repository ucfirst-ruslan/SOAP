<?php

include_once 'servises/getService.php';

class Model
{
	private $request;
	private $celsius;
	private $country;
	private $error;

	public function __construct()
	{
		$this->request = new getService();
		$this->error = [];
	}

	public function getCelsius()
	{
		return $this->celsius;
	}
	
	public function getCountry()
	{
		return $this->country;
	}

	public function getError()
	{
		return $this->error;
	}

	public function sendRequestCelsius($dataset)
	{
		if (is_numeric($dataset['celsius']))
		{
			$data = array(TEMP_DATA => $dataset['celsius']);

			return $this->request->setData($data)->setURL(TEMP_URL)->setSection(TEMP_SECTION)->getContent($dataset['mode']);
			
		}

		$this->error['celsius'] = CELSIUS_ERROR;
		return false;
	}
	
	public function sendRequestCountry($dataset)
	{
		if (preg_match('/^[A-Za-z]{2}+$/', $dataset['country']))
		{
			$data = array(COUNTRY_DATA => strtoupper($dataset['country']));

			return $this->request->setData($data)->setURL(COUNTRY_URL)->setSection(COUNTRY_SECTION)->getContent($dataset['mode']);
		}
		$this->error['country'] = COUNTRY_ERROR;
		return false;
	}
}