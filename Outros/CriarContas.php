<?php 

try 
{
  $db = new PDO('sqlite:database.sqlite');
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $res = $db->exec(
    "CREATE TABLE IF NOT EXISTS contas (
        id INTEGER PRIMARY KEY AUTOINCREMENT, 
        id_usuario INTERGER,
        descricao VARCHAR(100), 
        tipo CHAR(1), 
        saldo NUMERIC(10,2)
     )"
  );

  echo 'crido....';
   
} catch (PDOException $ex) {
  echo $ex->getMessage();
}

