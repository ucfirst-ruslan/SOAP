<?php
include_once 'libs/AbstractSoap.php';
include_once 'libs/ICountryInfo.php';
class CountryInfoSoap extends AbstractSoap implements ICountryInfo
{
  function __construct()
  {
      $this->connect(COUNTRYINFO_URL);
  }
  
  public function getContinents()
  {
    return $this->call('ListOfContinentsByName')->ListOfContinentsByNameResult->tContinent;
  }
  
  public function getCountries()
  {
    return $this->call('ListOfCountryNamesByName')->ListOfCountryNamesByNameResult->tCountryCodeAndName;
  }
  
  public function getCountryFullInfo($isoCode)
  {
    return $this->call('FullCountryInfo',array('sCountryISOCode'=>$isoCode))->FullCountryInfoResult;
  }
}