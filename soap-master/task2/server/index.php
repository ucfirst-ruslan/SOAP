<?php
require_once 'autoload.php';
require_once 'config.php';

ini_set("soap.wsdl_cache_enabled", 0);

if(array_key_exists('wsdl', $_GET))
{
  header("Content-Type: text/xml; charset=utf-8");
  header('Cache-Control: no-store, no-cache');
  header('Expires: '.date('r'));
  
  echo file_get_contents(WSDL_PATH);
  exit;
}
else
{
  $server = new SoapServer('http://php-kossworm917948.codeanyapp.com/soap/task2/server/?wsdl');
  $server->setClass("libs\services\SoapService");
  $server->handle();
}

// $carService = new libs\services\CarService(new libs\MysqlExecutor());
// try
// {
//   var_dump($carService->getShortList());
//   echo '<br />';
//   var_dump($carService->getLongList());
// }
// catch(Exception $e)
// {
//   echo '<pre>'.$e->getMessage().'</pre>';
//   echo '<br />';
//   echo '<pre>'.$e->getTraceAsString().'</pre>';
// }
