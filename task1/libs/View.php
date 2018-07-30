<?php

class View
{
	/**
	 * @param $template
	 * @param null $dataset
	 */
	public function renderView($template, $dataset=null)
	{
		include_once __DIR__ .'/../'. $template;
	}
}