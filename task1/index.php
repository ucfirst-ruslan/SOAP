<?php
//ini_set('display_errors', 1);
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

/* $client = new SoapClient("http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL", array('trace' => 1));
$param = [
	"ubiNum" => "125"
];
$resNumb = $client->NumberToWords($param);
echo "REQUEST:\n" . $client->__getLastRequest() . "\n"; */



 
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
		
		
		$url = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso';
		$data = array("sCountryISOCode"=>"UA");


		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		$output = curl_exec($ch); 
		$info = curl_getinfo($ch);      
		curl_close($ch);

		//$xml = (array)simplexml_load_string($output);

		var_dump($output);

		http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso
		
		
		
		
		
