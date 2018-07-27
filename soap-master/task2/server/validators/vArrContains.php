<?php

namespace validators;

class vArrContains implements iValidator
{
	private $sourceArray;

	public function __construct()
	{
		$sourceArray = array();
	}

	public function setArr($arr)
	{
        $this->sourceArray = $arr;
        return $this;
	}

    public function isValid(&$var)
    {
        if (false !== array_search($var, $this->sourceArray))
        {
            return true;
        }
        else
        {
           throw new \exceptions\ValidationException(NOT_ALLOWED_VALUE_ERROR); 
        }
    }
}
?>
