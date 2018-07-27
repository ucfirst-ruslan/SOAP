<?php

require_once("libs/config.php");
require_once 'libs/Controller.php';
require_once 'libs/AbstractCurl.php';
  
try
{
  $obj = new Controller();
}
catch(Exception $e)
{
  echo $e->getMessage();	           
}
