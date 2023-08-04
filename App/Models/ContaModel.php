<?php


/**********************************************************************/
class ContaModel{

  public function __constructor()
  {
       $this->id;
       $this->id_usuario;
       $this->descricao; 
       $this->tipo; 
       $this->saldo;
  }


  
 /***********************************************/
  public function findAll()
  {

     $db = Conexao::conectar();  

     $id_uso = (int) Sessao::getDadosSessao()['id'];
    
     $resultado = $db->query("SELECT * FROM contas WHERE id_usuario = {$id_uso}");  
    
     $dados = [];
                  
      foreach ($resultado as $cta)
      {
      
        $item = array(
               'id'     => $cta['id'],
               'id_usuario' => $cta['id_usuario'],
               'descricao'   => $cta['descricao'],
               'tipo'  => $cta['tipo'],
               'saldo' => $cta['saldo']
            );
      
        array_push($dados, $item);
                             
      }

      return $dados;
  }

  
  /***********************************************/
  public function findId()
  {

     $db = Conexao::conectar();  

      $id_uso = (int) Sessao::getDadosSessao()['id'];
    
     $resultado = $db->query("SELECT * FROM contas WHERE id = {$this->id} AND id_usuario = {$id_uso}");  

     $dados = $resultado->fetch(PDO::FETCH_ASSOC);

     return ([
           'id'     => $dados['id'],
           'id_usuario'   => $dados['id_usuario'],
           'descricao'  => $dados['descricao'],          
           'tipo'  => $dados['tipo'],
           'saldo' => $dados['saldo']
     ]);
     
  }

  
  
  /**********************************************************/
  public function salvar()
  {

     $db = Conexao::conectar();  
    
     $query = "INSERT INTO contas (id_usuario, descricao, tipo, saldo) 
               VALUES (:id_usuario, :descricao, :tipo, :saldo)";  

     $stmt = $db->prepare($query);
  
     // Bind values directly to statement variables
     $stmt->bindValue(':id_usuario' , $this->id_usuario, SQLITE3_INTEGER);
     $stmt->bindValue(':descricao'  , $this->descricao , SQLITE3_TEXT);
     $stmt->bindValue(':tipo'       , $this->tipo      , SQLITE3_TEXT);
     $stmt->bindValue(':saldo'      , $this->saldo     , SQLITE3_FLOAT);
    
     $contador = $stmt->execute();    

     return $contador; 
    
  }

  
  /**********************************************************/
  public function deletar()
  {

     $db = Conexao::conectar();  
    
     $query = "DELETE FROM contas WHERE id = :id";  

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':id', $this->id, SQLITE3_INTEGER);
    
     $contador = $stmt->execute();    

     return $contador; 
    
  }

  
  /**********************************************************/
  public function update()
  {

     $db = Conexao::conectar();  
    
     $query = "UPDATE contas 
                  SET descricao = :descricao,
                      tipo = :tipo
               WHERE  id = {$this->id}";    

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':descricao', $this->descricao, SQLITE3_TEXT);
     $stmt->bindValue(':tipo'     , $this->tipo     , SQLITE3_INTEGER);
  
     $contador = $stmt->execute();    

     return $contador; 
    
  }
  

  /**********************************************************/
  public function updateSaldo()
  {

     $db = Conexao::conectar();  
    
     $query = "UPDATE contas 
                  SET saldo = :saldo
               WHERE  id = {$this->id}";    

     $stmt = $db->prepare($query);
  
    $stmt->bindValue(':saldo'     , $this->saldo     , SQLITE3_FLOAT);
  
     $contador = $stmt->execute();    

     return $contador; 
    
  }
  
}