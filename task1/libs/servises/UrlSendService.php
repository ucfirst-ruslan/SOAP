<?php


class UrlSendService
{

	private $parameter;
	private $result;

	public function setParameter($parameter)
	{
		$this->parameter = $parameter;
	}

	public function setFunction ($function)
	{
		if (!empty($function))
		{
			$this->function = $function;
		}
		else
		{
			throw new Exception ("Field is empty");
		}
	}

	public function getResult()
	{
		$url = 'https://www.w3schools.com/xml/tempconvert.asmx/'.$this->function;
		$postResponse = $this->curlPost($url, $this->post);
		return $postResponse;
	}


	private function curlPost($url, $post) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.w3schools.com', 'Content-Type: application/x-www-form-urlencoded', 'Content-Length: '.strlen($post)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		if($info['http_code'] != 200)
		{
			throw new Exception ("cUrl error code :" . $info['http_code']);
		}

		curl_close($ch);
		$this->result = $result;
	}
}