<?php

include_once 'servises/getService.php';

class Model
{
	private $request;
	private $celsius;
	private $country;

	public function __construct()
	{
		$this->request = new getService();
	}

	public function getCelsius()
	{
		return $this->celsius;
	}
	
	public function getCountry()
	{
		return $this->country;
	}
	
	public function sendRequestCelsius()
	{
		if (is_numeric($_POST['celsius']))
		{
			$data = array(TEMP_DATA => $_POST['celsius']);
			
			return $this->request->setData($data)->setURL(TEMP_URL)->setSection(TEMP_SECTION)->getContent($_POST['mode']);
			
		}
		else
		{
			throw new Exception ("Field 'celsius' not number");
		}
	}
	
	public function sendRequestCountry()
	{
		if (preg_match('/^[A-Za-z]{2}+$/', $_POST['country']))
		{
			$data = array(TEMP_DATA => strtoupper($_POST['country']));
			
			return $this->request->setData($data)->setURL(TEMP_URL)->setSection(TEMP_SECTION)->getContent($_POST['mode']);			
		}
		else
		{
			throw new Exception ("The 'country' field is incorrect");
		}
		
	}
}