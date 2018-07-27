<?php

namespace libs;

class AbstractSoap
{
  private $client;
  
  function __construct($WsdlUrl)
  {
      $this->connect($WsdlUrl);
  }
    
  protected function connect($WsdlUrl)
  {
      $this->client = new \SoapClient($WsdlUrl, array(
                'exceptions'=>true,
                'trace'=>1,
                'cache_wsdl'=>WSDL_CACHE_NONE));
  }
  
  public function getAllFunc()
  {
    return $this->client->__getFunctions();
  }
  
  protected function call($name,$params=NULL) 
  {
    if($params)
    {
      return $this->client->$name($params);
    }
    return $this->client->$name();
  }
  
}
