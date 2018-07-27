<?php
include_once 'libs/AbstractCurl.php';
include_once 'libs/ICountryInfo.php';
class CountryInfoCurl extends AbstractCurl implements ICountryInfo
{
  function __construct()
  {
      $this->connect(COUNTRYINFO_URL);
  }
  
  public function getContinents()
  {
    $result = array();
    $response =  $this->call('ListOfContinentsByName');
    libxml_use_internal_errors(true);
		$dom=new DomDocument();
		$dom->loadHTML($response);
    $continent = $dom->getElementsByTagName('arrayoftcontinent')->item(0)->getElementsByTagName('tcontinent');
    for($i=0;$i<$continent->length;$i++)
    {
      $item = $continent->item($i);
      $code = $item->firstChild;
      $name = $item->lastChild;
      array_push($result, array('sName'=>$name->nodeValue, 'sCode'=>$code->nodeValue));
    }
    
    return $result;
  }
  
  public function getCountries()
  {
    $result = array();
    $response =  $this->call('ListOfCountryNamesByName');
    libxml_use_internal_errors(true);
		$dom=new DomDocument();
		$dom->loadHTML($response);
    $continent = $dom->getElementsByTagName('arrayoftcountrycodeandname')->item(0)->getElementsByTagName('tcountrycodeandname');
    for($i=0;$i<$continent->length;$i++)
    {
      $item = $continent->item($i);
      $code = $item->firstChild;
      $name = $item->lastChild;
      array_push($result, array('sName'=>$name->nodeValue, 'sISOCode'=>$code->nodeValue));
    }
    
    return $result;
  }
  
  public function getCountryFullInfo($isoCode)
  {
    //print_r($isoCode);
    return $this->call('FullCountryInfo',array('sCountryISOCode'=>$isoCode));
  }
}