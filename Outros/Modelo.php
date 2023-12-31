<?php 

try {
  $db = new PDO('sqlite:database.sqlite');
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $res = $db->exec(
    "CREATE TABLE IF NOT EXISTS usuario (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      nome TEXT, 
      login TEXT, 
      senha TEXT,
      status text
    )"
  );
  
  $stmt = $db->prepare(
    "INSERT INTO usuario (nome,login, senha, status) 
      VALUES (:nome, :login, :senha, :status)"
  );
  
  // Bind values directly to statement variables
  $stmt->bindValue(':nome', 'Elizabetes', SQLITE3_TEXT);
  $stmt->bindValue(':login', 'ELIZABETE', SQLITE3_TEXT);
  $stmt->bindValue(':senha', '654321', SQLITE3_TEXT);
  $stmt->bindValue(':status', 'A', SQLITE3_TEXT);
 
  
  // Format unix time to timestamp
 // $formatted_time = date('Y-m-d H:i:s');
 // $stmt->bindValue(':time', $formatted_time, SQLITE3_TEXT);
   
 // Execute statement
 $stmt->execute();
  
  $messages = $db->query("SELECT * FROM usuario");
    
  // Garbage collect db
  $db = null;
} catch (PDOException $ex) {
  echo $ex->getMessage();
}
  
/*

<?php
unlink('mysqlitedb.db');
$db = new SQLite3('mysqlitedb.db');

$db->exec('CREATE TABLE foo (id INTEGER, bar STRING)');
$db->exec("INSERT INTO foo (id, bar) VALUES (1, 'This is a test')");

$stmt = $db->prepare('SELECT bar FROM foo WHERE id=:id');
$stmt->bindValue(':id', 1, SQLITE3_INTEGER);

$result = $stmt->execute();
var_dump($result->fetchArray());
?>


*/

?>

<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>
    <?= '<h1>USUÁRIOS</h1>'; ?>
    
    <?php foreach ($messages as $msg) { 
      echo '<p>';
        echo '<h4>' . $msg['nome'] . '</h4>';
        echo $msg['login']. '<br>';  
        echo $msg['senha']. '<br>';  
        echo $msg['status']. '<br>';  
      echo '</p>';
    } ?>
  </body>
</html>




