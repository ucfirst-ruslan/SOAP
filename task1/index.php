<?php
ini_set('display_errors', 1);
/*include ('config.php');
include ('libs/Controller.php');
include ('libs/View.php');
include ('libs/Model.php');


try
{
	$obj = new Controller();
}
catch(Exception $e)
{
	echo $e->getMessage();
}*/

//$client = new SoapClient("https://www.w3schools.com/xml/tempconvert.asmx?WSDL");
//$param = array('Celsius' => '56');
//$resNumb = $client->CelsiusToFahrenheit($param);
//var_dump($resNumb->CelsiusToFahrenheitResult);


$client = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");
$t = 'UA';
$param = array('sCountryISOCode' => $t);
$resNumb = $client->FullCountryInfo($param);

$section = 'FullCountryInfo'.'Result';
var_dump((array)$resNumb->$section);

 
        /* $url = 'https://www.w3schools.com/xml/tempconvert.asmx/CelsiusToFahrenheit';
		$data = array('Celsius' => '56');


		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		
		$output = curl_exec($ch); 
		$info = curl_getinfo($ch);      
		curl_close($ch);

		$xml = (array)simplexml_load_string($output);

		var_dump($xml[0]); */

        //Рабочий код

//$url = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/FullCountryInfo';
//		$data = array("sCountryISOCode"=>"UA");
////$data = null;
//
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//		curl_setopt($ch, CURLOPT_POST, 1);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//
//		$output = curl_exec($ch);
//		$info = curl_getinfo($ch);
//		curl_close($ch);
//
//$xml = (array)simplexml_load_string($output);
//var_dump($xml);

		
		
		
		
