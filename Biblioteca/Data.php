<?php

class Data {

    private static $data;
    private static $dia;
    private static $mes;
    private static $ano;
  
    /***************************************************************/
    public static function __constructor()
    {
  
      self::$data = '00/00/0000';
  
      return self::$data;
       
    }
  
    /***************************************************************/
    public static function getData()
    {
  
      return self::$data;
    
    }
  
    /***************************************************************/ 
    public static function setData()
    {
  
  
      
    }  
  
    /***************************************************************/ 
    public static function dataToStr($data)
    {
  
      
    }
  
    /***************************************************************/ 
    public static function strToData($data)
    {
  
      
    }
  
    /***************************************************************/ 
    public static function getDiaData()
    {
  
      
    
    }
  
    /***************************************************************/ 
    public static function getMesData()
    {
  
       
      
    }  
  
    /***************************************************************/ 
   public static function getAnoData()
   {
  
      
   }   
  
}