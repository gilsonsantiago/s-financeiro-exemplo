<?php


    /***************************************************************/ 
    function getDia($data)
    {

      return substr($data->data, 8, 2);
    
    }
  
    /***************************************************************/ 
    function getMes($data)
    {
      
       return substr($data, 5, 2);
      
    }  
  
   /***************************************************************/ 
   function getAno($data)
   {
  
       return substr($data, 0, 4);
     
   }   
