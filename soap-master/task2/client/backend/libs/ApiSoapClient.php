<?php

namespace libs;

class ApiSoapClient extends AbstractSoap
{ 
  private $soapClient;
  
  public function __construct()
  {
     $this->connect(WSDL_PATH); 
  }
  
  public function getCarList()
  {
    return $this->call('getCarList');
  }
  
  public function getById($id)
  {
    return $this->call('getById', array('id'=>$id));
  }
  
  public function Order($order)
  {
    return $this->call('Order', $order);
  }
}