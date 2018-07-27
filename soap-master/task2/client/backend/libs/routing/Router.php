<?php

namespace libs\routing;

class Router
{
  private static $_routes = array();
  private static $_instance = null;
  
  private function __construct() 
  { 
  }
  
  protected function __clone()
  {
  }
  
  static public function getInstance()
  {
    if(is_null(self::$_instance))
    {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
  
  public function register($method, $path, $class, $function)
  {
    
  }
  
  public function configure($ctrlsNamespace=null)
  {
    if(is_array($ctrlsNamespace))
    {
      
    }
    else
    {
      $this->scanCtrlDir($ctrlsNamespace);
    }
  }
  
  private function scanCtrlDir($dir)
  {
    $path = BASE_DIR.'/'.str_replace("\\", "/", $dir);
    if(is_dir($path))
    {      
      $items = scandir($path);
      foreach($items as $file)
      {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if(is_file($path.$file) && 0===strcmp('php',$ext))
        {
          $clasName = pathinfo($file, PATHINFO_FILENAME);
          $reflect = new \ReflectionClass($dir.$clasName);
          if(true === $reflect->implementsInterface(BASE_CTRL) && false === $reflect->isInterface())
          {
            var_dump($reflect);            
          }
          
        }
      }
    }
  }
}
