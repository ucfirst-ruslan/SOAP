<?php

include_once 'IGetServices.php';
include_once 'curlService.php';
include_once 'soapService.php';

/**
 * Class getService
 *
 * В принципе использование трейтов тут не имеет особого смысла,
 * но мне хотелось попробовать эту технологию.
 */
class getService implements IGetServices
{
	use curlService, soapService;
		
	protected $url;
	protected $data;
	protected $section;

	/**
	 * @param $data
	 * @return $this->data
	 * @throws Exception
	 */
	public function setData($data)
	{
		if (!empty($data))
		{
			$this->data = $data;
		}
		else
		{
			throw new Exception ("Field 'data' is empty");
		}
		return $this;
	}

	/**
	 * @param $url
	 * @return $this->url
	 * @throws Exception
	 */
	public function setURL($url)
	{
		if (!empty($url))
		{
			$this->url = $url;
		}
		else
		{
			throw new Exception ("Field 'url' is empty");
		}
		return $this;
	}


	/**
	 * @param mixed $section
	 * @return $this
	 * @throws Exception
	 */
	public function setSection($section)
	{
		if (!empty($section))
		{
			$this->section = $section;
		}
		else
		{
			throw new Exception ("Section is empty");
		}
		return $this;
	}

	public function getContent($mode='SOAP')
	{
		if ('SOAP' == $mode)
		{
			$this->soapGetContent();
			return $this->content;
		}

		$this->curlGetContent();
		return $this->content;
	}
}