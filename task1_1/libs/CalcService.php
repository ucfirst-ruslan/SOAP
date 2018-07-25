<?php  
include_once 'libs/config.php';
include_once 'libs/calculator.php';

class CalcService {

	public function getResult($a, $b, $method) {

		$calc = new Calculator();

		if (method_exists($calc, $method)) 
		{
			
			$calc->setDate((int)$a, (int)$b);

			if (!$calc->getError()) 
			{
				return $calc->$method();
			}
			else
			{
			throw new SoapFault("Server", "Error operation: " . $calc->getError() . ".");
			}
		}
		else
		{
			throw new SoapFault("Server", "Unknown method " . $method . ".");
		}
	}
}
