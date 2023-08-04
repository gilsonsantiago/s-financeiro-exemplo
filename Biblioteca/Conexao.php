<?php 

//namespace Biblioteca;

class Conexao{

  private static $db;

  /***************************************************************/
  public function conectar()
  {
      if(!isset(self::$db))
      {
         self::$db = new PDO('sqlite:database.sqlite');

         self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         return self::$db;
          
      } 
      else
      {
        return self::$db;
      }  
  }

  
  /**********************************************************/
  public static function desconectar()
  {

     return self::$db = '';
    
  }   
  
}