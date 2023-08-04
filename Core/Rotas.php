<?php

class Rotas{

  private static $url;

  /***************************************************************/
  public static function  __constructor()
  {

     self::$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
  }

  public static function pegarRota()
  {

     return self::$url;
  }
  
}



