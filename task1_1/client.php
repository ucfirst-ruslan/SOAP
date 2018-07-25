<?php //ini_set('display_errors', 1);

$client = new SoapClient("calc.wsdl");

try
{
	print "Response: ". $client->getResult(11, 20, "summ");
}
catch (SoapFault $exception)
{
	echo $exception;
}