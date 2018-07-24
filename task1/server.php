<?php
ini_set("soap.wsdl_cache_enabled", 0); 

include_once 'libs/CalcService.php';

$server = new SoapServer("calc.wsdl");
$server->setClass("CalcService");  
$server->handle(); 