<?php
require_once 'autoload.php';
require_once 'config.php';

$router = libs\routing\Router::getInstance();
$router->configure('libs\Ctrls\\');

// var_dump($_SERVER['REQUEST_URI']);
// echo '<br />';
// var_dump($_REQUEST['path']);
// echo '<br />';
// var_dump($_SERVER['REQUEST_METHOD']);

// $soapClient = new libs\ApiSoapClient();

// echo '<pre>';
// var_dump($soapClient->getAllFunc());
// echo '</pre>';
//  $result = $soapClient->getCarList();
//  echo '<pre>';
//  var_dump($result);
//  echo '</pre>';
//  $idresult = $soapClient->getById(1);
//  echo '<pre>';
//  var_dump($idresult);
//  echo '</pre>';
//  $obj = array( 'idcar'=>1,
//                'firstname'=>'Kostya',
//                'lastname'=>'Osm',
//                'payment'=>'cash');

//  $soapClient->Order((object)$obj);

