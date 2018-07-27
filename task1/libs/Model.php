<?php

include_once 'servises/getService.php';

class Model
{
	private $request;


	public function __construct()
	{
		$this->request = new getService();
	}


	public function sendRequest()
	{

	}
}