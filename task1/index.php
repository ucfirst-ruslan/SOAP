<?php //ini_set('display_errors', 1);

include ('config.php');
include ('libs/Controller.php');

try
{
	$obj = new Controller();
}
catch(Exception $e)
{
	echo $e->getMessage();
}
