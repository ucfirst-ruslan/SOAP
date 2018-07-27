<?php

namespace libs\services;

class SoapService
{
  private $carService;
  
  public function __construct($carService=null)
  {
    if($carService !==null)
    {
      $this->carService = $carService;
    }
    else
    {
      $this->carService = new CarService(new \libs\MysqlExecutor());
    }
  }
  
  public function getCarList()
  {
    $result = $this->carService->getShortList();    
    return array_map(function($car){ return (object)$car; },$result);    
  }
  
  public function getById($param)
  {
    $result = $this->carService->getById($param->id);
    return (object)$result[0];
  }
   public function Order($order)
  {
    $this->carService->Order($order);
  }
}