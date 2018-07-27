<?php


trait curlService
{
	protected $content;

	/**
	 * @return $this->content
	 * @throws Exception
	 */
	private function curlGetContent()
	{
		$section = $this->section;
		$url = $this->url.'/'.$section;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));

		$content = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);

		if (200 == $info['http_code'])
		{
			$this->content = (array)simplexml_load_string($content);
		}
		else
		{
			throw new Exception ("Error cUrl request");
		}
	}
}