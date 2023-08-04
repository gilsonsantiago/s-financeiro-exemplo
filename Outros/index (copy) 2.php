<?php 

try {
  
  $db = new PDO('sqlite:database.sqlite');
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
  $messages = $db->query("SELECT * FROM messages");

   
} catch (PDOException $ex) {
  
  echo $ex->getMessage();
  
}

?>

<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>
    <?= '<h1>Messages</h1>'; ?>
    
    <?php foreach ($messages as $msg) { 
      echo '<p>';
        echo '<h4>' . $msg['title'] . '</h4>';
        echo $msg['message'];  
      echo '</p>';
    } ?>
  </body>
</html>