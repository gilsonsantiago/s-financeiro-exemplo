<?php 

try {
  $db = new PDO('sqlite:database.sqlite');
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $res = $db->exec(
    "CREATE TABLE IF NOT EXISTS usuario (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      nome VARCHAR(100), 
      login VARCHAR(100), 
      senha VARCHAR(100),
      status CHAR(1)
    )"
  );
  
 
  $db = null;} catch (PDOException $ex) {
  echo $ex->getMessage();
}

