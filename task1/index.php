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

$client = new SoapClient("http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL", array('trace' => 1));
$param = [
	"ubiNum" => "125"
];
$resNumb = $client->NumberToWords($param);
echo "REQUEST:\n" . $client->__getLastRequest() . "\n";

/*
 * $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetCitiesByCountry xmlns="http://www.webserviceX.NET">
      <CountryName>INDIA</CountryName>
    </GetCitiesByCountry>
  </soap:Body>
</soap:Envelope>';



$headers = array(
	"Content-type: text/xml;charset=\"utf-8\"",
	"Accept: text/xml",
	"Cache-Control: no-cache",
	"Pragma: no-cache",
	"SOAPAction: http://www.webservicex.com/globalweather.asmx",
	"Content-length: ".strlen($xml_post_string),
);

$url = $soapUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// converting
$response = curl_exec($ch);
curl_close($ch);
echo $response;
 */