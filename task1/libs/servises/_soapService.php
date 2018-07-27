<?php

include_once 'getService.php';

class soapService extends getService
{



	/**
	 * @return $this->content
	 * @throws Exception
	 */
	private function soapGetContent()
	{
		$url = $this->url.'?WSDL';
		$client = new SoapClient($url);
		$section = $this->section;
		$content = $client->$section($this->data);

		$section = $this->section.'Result';
		$this->content = (array)$content->$section;
	}
	
}
