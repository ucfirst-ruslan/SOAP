<?php
include_once 'libs/CountryInfoSoap.php';
include_once 'libs/CountryInfoCurl.php';
include_once 'libs/ISBNSoap.php';
include_once 'libs/ISBNCurl.php';

class Model
{
  private $model;
  
  public function __construct()
  {
    $this->model = array('TITLE'=>TASK_NAME, 'ERRORS'=>'');
    $countryInfoSoap = new CountryInfoSoap();
    $this->model['COUNTRYSOAPFUNCTIONS'] = implode('<br />',$this->getAvalibleEndpoints($countryInfoSoap));
    $this->model['COUNTRYURL'] = COUNTRYINFO_URL;
    $this->model['CONTINENTS'] = $countryInfoSoap->getContinents();
    $this->model['COUNTRIES'] = $countryInfoSoap->getCountries();
    $this->model['COUNTRYFULL'] = array($countryInfoSoap->getCountryFullInfo('UA'));
    
    $isbnSoap = new ISBNSoap();
    $this->model['ISBNSOAPFUNCTIONS'] = implode('<br />',$this->getAvalibleEndpoints($isbnSoap));
    $this->model['ISBNURL'] = ISBN_URL;
    $this->model['ISBNVALID'] = $isbnSoap->IsValidISBN13('9789667047702'); 
    
    $countryInfoCurl = new CountryInfoCurl();
    $this->model['COUNTRYCURLFUNCTIONS'] = $this->getAvalibleEndpoints($countryInfoCurl);
    $this->model['CONTINENTSCURL'] = $countryInfoCurl->getContinents();
    $this->model['COUNTRIESCURL'] = $countryInfoCurl->getCountries();
    $this->model['COUNTRYFULLSOAP'] = array($countryInfoSoap->getCountryFullInfo('UA'));
    
    $isbnCurl = new ISBNCurl();
    $this->model['ISBNSOAPFUNCTIONSCURL'] = $this->getAvalibleEndpoints($isbnCurl);
    $this->model['ISBNURL'] = ISBN_URL;
    $this->model['ISBNVALIDCURL'] = $isbnCurl->IsValidISBN13('9789667047702');
  }
  
  public function addError($text)
  {
	  $this->model['ERRORS'].=$this->model['ERRORS'].'<pre>'.$text.'</pre>'.' <br />\n';
  }
  
  public function getAvalibleEndpoints($connection)
  {
    return $connection->getAllFunc();
  }
  
  public function getArray()
  {
		return $this->model;
  }
}