<?php 

try {
  $db = new PDO('sqlite:database.sqlite');
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $res = $db->exec(
    "CREATE TABLE IF NOT EXISTS movimento (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      id_usuario INTEGER, 
      id_conta INTEGER, 
      nota TEXT,
      opera CHAR(1),
      data VARCHAR(10),
      valor NUMERIC(10,2)
    )"
  );
   
  $db = null;
  
} catch (PDOException $ex) {
  echo $ex->getMessage();
}

