<?php


class Sessao{

  private static $logado;

  public static function __constructor()
  {
       $this->logado = false;
  }


  
  /********************************************************/
  public static function sessaoInit()
  {

       if(session_status() == PHP_SESSION_NONE) 
       {
             session_start();             
       }
    
  }

  
  /*****************************************************/
  public static function sessaoExiste()
  {
       if(session_status()) 
       {
         return true;            
       }
       else
       {
         return false;   
       }   
      
  }

  /*******************************************************/
  public static function sessaoExcluir()
  {

    if(sessaoExiste())
    {
      session_destroy();
    }  
       
    
  }


  /****************************************************************/
  public static function isLogado()
  {

    if($_SESSION['user_id'])
    {
        return true;
    }  
    else
    {
        return false;
    }  

    
  }
  
  /***************************************************************/
  public static function logarUsuario($usuariologado)
  {

       $_SESSION['user_id'] = $usuariologado;  
    
  }

  
  /*********************************************************/
  public static function logarOut()
  {

    if(self::isLogado())
    {
     
      unset($_SESSION['user_id']);
      
    }  
    
  }

  
  /**********************************************/
  public static function getDadosSessao()
  {

   if(self::isLogado())
   {

     return($_SESSION['user_id']);
     
   }  
   else
   {

     return [];
     
   }  
    
    
    
  }
  
    
}