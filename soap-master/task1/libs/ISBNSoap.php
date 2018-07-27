<?php
include_once 'libs/AbstractSoap.php';

class ISBNSoap extends AbstractSoap
{
  function __construct()
  {
      $this->connect(ISBN_URL);
  }
  
   public function IsValidISBN13($isbn)
   {
     return $this->call('IsValidISBN13',array('sISBN'=>$isbn))->IsValidISBN13Result;
   }
  
}