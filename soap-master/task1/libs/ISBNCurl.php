<?php
include_once 'libs/AbstractCurl.php';

class ISBNCurl extends AbstractCurl
{
  function __construct()
  {
      $this->connect(ISBN_URL);
  }
  
   public function IsValidISBN13($isbn)
   {
     $result = $this->call('IsValidISBN13',array('sISBN'=>$isbn));
     libxml_use_internal_errors(true);
		 $dom=new DomDocument();
		 $dom->loadHTML($result);
     $value = $dom->getElementsByTagName('boolean')->item(0)->nodeValue;
     if("true"===$value)
     {
       return true;
     }
     return false;
   }
  
}