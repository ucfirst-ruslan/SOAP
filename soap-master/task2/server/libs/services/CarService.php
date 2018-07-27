<?php
namespace libs\services;
class CarService
{
  private $executor;
  
  public function __construct($executor)
  {
    $this->executor = $executor;    
  }
  
  public function getShortList()
  {
    return $this->executor->select(array('cars.id', 'mark.nam AS mark', 'model.nam AS model'))
              ->setTable(array('cars'))
              ->join('model','model.id','cars.idmodel')
              ->join('mark','model.idmark','mark.id')
              ->exec();
  }
  
  public function getById($id)
  {
    return $this->executor->select(array('cars.id', 'mark.nam AS mark', 'model.nam AS model', 'cars.year', 'cars.engine', 'cars.color', 'cars.maxspeed', 'cars.price'))
      ->setTable(array('cars'))
      ->join('model','model.id','cars.idmodel')
      ->join('mark','model.idmark','mark.id')
      ->setParam(array('id' => $id))
		  ->where('cars.id','=',':id')
      ->exec();
  }
  public function Order($order)
  {
    $this->executor
        ->insert((array)$order)
				->setTable('orders')
        ->exec();
        
  }
}