<?php 

$db = new PDO('sqlite:database.sqlite');

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

  $stmt = $db->prepare(
    "INSERT INTO usuario (nome,login, senha, status) 
      VALUES (:nome, :login, :senha, :status)"
  );
  
  // Bind values directly to statement variables
  $stmt->bindValue(':nome',   'Administrador', SQLITE3_TEXT);
  $stmt->bindValue(':login',  'ADMIN', SQLITE3_TEXT);
  $stmt->bindValue(':senha',  '$2y$10$Tws1.bLshhkfIcnHcJiZXepXyjcaD3sGbU059RXmgscMjH3JHPj1e', SQLITE3_TEXT);
  $stmt->bindValue(':status', '3', SQLITE3_TEXT);
 
  
  // Format unix time to timestamp
 // $formatted_time = date('Y-m-d H:i:s');
 // $stmt->bindValue(':time', $formatted_time, SQLITE3_TEXT);
   
 // Execute statement
 $stmt->execute();
 
  $db = null;
 } catch (PDOException $ex) {
  echo $ex->getMessage();
}


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

