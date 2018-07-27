<?php
interface ICountryInfo
{
  public function getAllFunc();
  public function getContinents();
  public function getCountries();
  public function getCountryFullInfo($isoCode);
}