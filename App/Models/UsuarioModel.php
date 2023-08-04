<?php

class UsuarioModel{

  public $id, $nome, $login, $senha, $status;

  public function __constructor()
  {

      $this->id     = 0;
      $this->nome   = '';
      $this->login  = '';
      $this->senha  = '';
      $this->status = '';
    
  }

  
  
  /***********************************************/
  public function findAll()
  {

     $db = Conexao::conectar();  
    
     $resultado = $db->query("SELECT * FROM usuario");  
    
     $dados = [];
                  
      foreach ($resultado as $usu)
      {
      
        $item = array(
               'id' => $usu['id'],
               'nome' => $usu['nome'],
               'login' => $usu['login'],
               'status' => $usu['status']
            );
      
        array_push($dados, $item);
                             
      }

      return $dados;
  }


  
  /***********************************************/
  public function findId()
  {

     $db = Conexao::conectar();  
    
     $resultado = $db->query("SELECT * FROM usuario WHERE id = {$this->id}");  

     $dados = $resultado->fetch(PDO::FETCH_ASSOC);

     return ([
           'id'     => $dados['id'],
           'nome'   => $dados['nome'],
           'login'  => $dados['login'],          
           'senha'  => $dados['senha'],
           'status' => $dados['status']
     ]);
     
  }

  
  
  /***********************************************/
  public function findLogin()
  {

      $db = Conexao::conectar();  
    
     $resultado = $db->query("SELECT * FROM usuario");  
    
     $dados = [];
                  
      foreach ($resultado as $usu)
      {
      
        $item = array(
               'id' => $usu['id'],
               'nome' => $usu['nome'],
               'login' => $usu['login'],
               'senha' => $usu['senha'],
               'status' => $usu['status']
            );
      
        array_push($dados, $item);
                             
      }

      return $dados;
     
  }

 
  /**********************************************************/
  public function salvar()
  {

     $db = Conexao::conectar();  
    
     $query = "INSERT INTO usuario (nome, login, senha, status) 
               VALUES (:nome, :login, :senha, :status )";  

     $stmt = $db->prepare($query);
  
     // Bind values directly to statement variables
     $stmt->bindValue(':nome'  , $this->nome  , SQLITE3_TEXT);
     $stmt->bindValue(':login' , $this->login , SQLITE3_TEXT);
     $stmt->bindValue(':senha' , $this->senha , SQLITE3_TEXT);
     $stmt->bindValue(':status', $this->status, SQLITE3_TEXT);
    
     // Format unix time to timestamp
     // $formatted_time = date('Y-m-d H:i:s');    
     // $stmt->bindValue(':time', $formatted_time, SQLITE3_TEXT);
     
     // Execute statement
    
     $contador = $stmt->execute();    

     return $contador; 
    
  }

 
  /**********************************************************/
  public function update()
  {

     $db = Conexao::conectar();  
    
     $query = "UPDATE usuario 
                  SET nome   = :nome,
                      login  = :login,
                      senha  = :senha,
                      status = :status
               WHERE  id = {$this->id}";      ;  

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':nome'  , $this->nome  , SQLITE3_TEXT);
     $stmt->bindValue(':login' , $this->login , SQLITE3_TEXT);
     $stmt->bindValue(':senha' , $this->senha , SQLITE3_TEXT);
     $stmt->bindValue(':status', $this->status, SQLITE3_TEXT);
     
     $contador = $stmt->execute();    

     return $contador; 
    
  }


  /**********************************************************/
  public function deletar()
  {

     $db = Conexao::conectar();  
    
     $query = "DELETE FROM usuario WHERE id = :id";  

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':id', $this->id, SQLITE3_INTEGER);
    
     $contador = $stmt->execute();    

    return $contador; 
    
  }

  
  
}