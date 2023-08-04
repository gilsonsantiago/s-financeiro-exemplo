<?php 

try {
        $db = new PDO('sqlite:database.sqlite');
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $res = $db->exec(
          'DELETE FROM messages'
        );

        echo 'Apagado';
  
    } catch (PDOException $ex) {
      
        echo $ex->getMessage();
  
    } 
  
 ?>