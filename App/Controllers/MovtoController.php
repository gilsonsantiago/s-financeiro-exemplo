<?php

class MovtoController{

 /*************************************************************/
  public function exibir()
  {

   $movto = New MovtoModel;

   $resultado = $movto->findAll();

   $lista = array(
     'nomeusuario' => Sessao::getDadosSessao()['nome'],
     'lista' => $resultado
   );
      
    printaTela('Listarmovimento.html', $lista);   
    
  }



  
  /****************************************************************/
  public function cadastrar()
  {

     $usuario = Sessao::getDadosSessao();

     $movtos = new MovtoModel;
    
     $contas = new ContaModel;

     $resultados = $contas->findAll();
    
     $lista = [
        'operacao'   => tipoOperacao(),
        'nomeusuario' => Sessao::getDadosSessao()['nome'],
        'titulo'     => 'Cadastrar Novo Lançamento',
        'conta'      => $resultados,
        'movto'      => $movtos,
        'urllink'    => '/salvarmovto'
     ];
    
     printaTela('CadastrarMovto.html', $lista);   
    
  }

  
 /********************************************************************/
  public function gravar()
  {
   
     $movto = new MovtoModel;
        
     $movto->id_usuario =  (int) Sessao::getDadosSessao()['id'];

     $movto->id_conta   =  strtoupper(filter_input(INPUT_POST, 'id_conta', FILTER_DEFAULT));

     $movto->opera      =  filter_input(INPUT_POST, 'opera', FILTER_DEFAULT);

     $movto->data       =  filter_input(INPUT_POST, 'data', FILTER_DEFAULT);

     $movto->valor      = filter_input(INPUT_POST, 'valor', FILTER_DEFAULT);    
   
     $numero = $movto->salvar();

     header('Location: /movto');

     exit;
    
  }


  /****************************************************************/
  public function editar()
  {

     $movtos = new MovtoModel;
     $contas = new ContaModel;
    
     $movtos->id = (int) filter_input(INPUT_POST, 'idedita'  , FILTER_DEFAULT);  // ok 
    
     $resultados = $contas->findAll();  
     $dado       = $movtos->findId();   

     $lista = [
        'operacao'   => tipoOperacao(),
        'nomeusuario' => Sessao::getDadosSessao()['nome'],
        'conta' => $resultados,
        'movto' => $dado,
        'titulo' => 'Alterar Lançamento',        
        'urllink' => '/alterarmovto'
     ];
    
     printaTela('CadastrarMovto.html', $lista);  
    
  }

  /********************************************************************/
  public function excluir()
  {

    $id = (int) filter_input(INPUT_POST, 'idapaga'  , FILTER_DEFAULT); 

    $movto = new MovtoModel();

    $movto->id = $id;

    $movto->deletar();

    header('Location: /movto');

    exit;
    
  }

  
  /****************************************************************/
  public function atualiza()
  {

     $movto = new MovtoModel();
    
     $movto->id         =  filter_input(INPUT_POST, 'idcadastro'  , FILTER_DEFAULT); 

     $movto->id_conta   =  strtoupper(filter_input(INPUT_POST, 'id_conta', FILTER_DEFAULT));
    
     $movto->opera      =  filter_input(INPUT_POST, 'opera', FILTER_DEFAULT);

     $movto->data       =  filter_input(INPUT_POST, 'data', FILTER_DEFAULT);

     $movto->valor      = filter_input(INPUT_POST, 'valor', FILTER_DEFAULT);    

     $numero = $movto->update();

     header('Location: /movto');

     exit;

  }
  


  
}
