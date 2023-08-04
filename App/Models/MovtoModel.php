<?php

class MovtoModel {

  public function __constructor()
  {
       $this->id;
       $this->id_usuario;
       $this->id_conta;
       $this->opera;
       $this->data;
       $this->valor; 
       $this->nota;
  }


  
 /***********************************************/
  public function findAll()
  {

     $db = Conexao::conectar();  

     $id_uso = (int) Sessao::getDadosSessao()['id'];
    
     $resultado = $db->query("SELECT movimento.id,
                                     movimento.id_usuario,
                                     movimento.id_conta,
                                     movimento.opera,
                                     movimento.data,
                                     movimento.valor                                     
                                FROM movimento
                               WHERE movimento.id_usuario = {$id_uso}");  
    
      $dados = [];
                  
      foreach ($resultado as $mvto)
      {

        $cta = new ContaModel;
        
        $cta->id = (int) $mvto['id_conta'];
        
        $resultado = $cta->findId();
      
        $item = array(
               'id'         => $mvto['id'],
               'id_usuario' => $mvto['id_usuario'],
               'id_conta'   => $mvto['id_conta'],
               'opera'      => $mvto['opera'],
               'data'       => $mvto['data'],
               'valor'      => $mvto['valor'],
               'descricao'  => $resultado['descricao']
               
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
    
     $resultado = $db->query("SELECT * FROM movimento WHERE id = {$this->id} AND id_usuario = {$id_uso}");  

     $dados = $resultado->fetch(PDO::FETCH_ASSOC);

     return ([
           'id'          => $dados['id'],
           'id_usuario'  => $dados['id_usuario'],
           'id_conta'    => $dados['id_conta'],          
           'opera'       => $dados['opera'],
           'data'        => $dados['data'],
           'valor'       => $dados['valor']
     ]);
     
  }

  

  /**********************************************************/
  public function salvar()
  {

     $db = Conexao::conectar();  
    
     $query = "INSERT INTO movimento (id_usuario, id_conta, data, valor) 
                    VALUES (:id_usuario, :id_conta, :data, :valor)";  

     $stmt = $db->prepare($query);
  
     // Bind values directly to statement variables
     $stmt->bindValue(':id_usuario' , $this->id_usuario, SQLITE3_INTEGER);
     $stmt->bindValue(':id_conta'   , $this->id_conta  , SQLITE3_INTEGER);
     $stmt->bindValue(':data'       , $this->data      , SQLITE3_TEXT);
     $stmt->bindValue(':valor'      , $this->valor     , SQLITE3_FLOAT);
    
     $contador = $stmt->execute();    

     return $contador; 
    
  }


  
  /**********************************************************/
  public function deletar()
  {

     $db = Conexao::conectar();  
    
     $query = "DELETE FROM movimento WHERE id = :id";  

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':id', $this->id, SQLITE3_INTEGER);
    
     $contador = $stmt->execute();    

     return $contador; 
    
  }


  
  /**********************************************************/
  public function update()
  {

     $db = Conexao::conectar();  
    
     $query = "UPDATE movimento 
                  SET id_conta = :id_conta,
                      data  = :data,
                      valor = :valor
               WHERE  id = {$this->id}";    

     $stmt = $db->prepare($query);
  
     $stmt->bindValue(':id_conta',  $this->id_conta, SQLITE3_INTEGER);
     $stmt->bindValue(':data',      $this->data,     SQLITE3_TEXT);
     $stmt->bindValue(':valor',     $this->valor,    SQLITE3_INTEGER);
  
     $contador = $stmt->execute();    

     return $contador; 
    
  }
  
  
}