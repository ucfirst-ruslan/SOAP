<?php

$data = new SoapClient(
     'http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL',
     array(
         'soap_version'=>SOAP_1_1,
         'cache_wsdl' => WSDL_CACHE_NONE,
         'trace'=>true
     )
 );
 
/* $request = $data->__soapCall('ProcessSRL',
      array (
          'SRLFile' => "/xml/whois.sri",
		  'RequestName' =>  "Whois",
          'key' => "microsoft.com"
      )
  ); */ 
 
 echo "<pre>";
var_dump($data->NumberToWords(["ubiNum"=>123]));
echo "</pre>";

/* Array
(
    [0] => string ProcessSRL(string $SRLFile, string $RequestName, string $key)
    [1] => string ProcessSRL2(string $SRLFile, string $RequestName, string $key1, string $key2)
    [2] => string ProcessSQL(string $DataSource, string $SQLStatement, string $UserName, string $Password)
) */