<?php
class AbstractCurl
{
  private $serviceUrl;
  private $functions;
  
  function __construct($WsdlUrl)
  {
    $this->connect($WsdlUrl);
  }
    
  protected function connect($WsdlUrl)
  {
      $this->serviceUrl = $WsdlUrl;
  }
  
  public function getAllFunc()
  {
    $result = array();
    $response = $this->getCurl($this->serviceUrl.'?WSDL');
    libxml_use_internal_errors(true);
		$dom=new DomDocument();
		$dom->loadHTML($response);
    
    $operations = $dom->getElementsByTagName('binding')->item(0)->getElementsByTagName('operation');
    for($i=0;$i<$operations->length;$i++)
    {
      $item = $operations->item($i);
      array_push($result, array('name'=>$item->getAttribute('name')));
    }
    $this->functions = $result;
    return $result;
  }
  
  protected function call($name,$params=NULL) 
  {
    var_dump($params);
    if($params)
    {
      return $this->postCurl($this->serviceUrl.'/'.$name,$params);
    }
    return $this->getCurl($this->serviceUrl.'/'.$name);
  }
  
  private function getCurl($url)
  { print_r($url);
    $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch); 
    $info = curl_getinfo($ch);      
    curl_close($ch);  
    return $output;    
  }
  
  private function postCurl($url,$data)
  { //print_r($url);
    //print_r($data);
    $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$output = curl_exec($ch); 
    $info = curl_getinfo($ch);      
    curl_close($ch);  
    return $output;   
  }
  
}
