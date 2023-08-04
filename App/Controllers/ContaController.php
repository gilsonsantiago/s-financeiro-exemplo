<?php


class ContaController{

  /*************************************************************/
  public function exibir()
  {

   $saldo = new RelatorioModel;
   $saldo->calcularSaldoContas();
    
   $conta = New ContaModel;
   $resultado =  $conta->findAll();

   $lista = array(
     'nomeusuario' => Sessao::getDadosSessao()['nome'],
     'lista' => $resultado
   );
      
    printaTela('Listarcontas.html', $lista);   
    
  }

  
  /****************************************************************/
  public function cadastrar()
  {

     $usuario = Sessao::getDadosSessao();

     $contas = new ContaModel();
    
     $lista = [
        'tipos' => tipoConta(),
        'titulo' => 'Cadastrar Nova Conta',
        'conta' => $contas,
        'urllink' => '/salvarconta'
     ];
    
     printaTela('CadastrarConta.html', $lista);   
    
  }

  
  /********************************************************************/
  public function gravar()
  {
     
     $conta = new ContaModel();
    
     $conta->id_usuario =  (int) Sessao::getDadosSessao()['id'];   //filter_input(INPUT_POST, 'idcadastro'  , FILTER_DEFAULT); 

     $conta->descricao  =  strtoupper(filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT));

     $conta->tipo       =  filter_input(INPUT_POST, 'tipo', FILTER_DEFAULT);
    
     $conta->valor = 0.00;

     $numero = $conta->salvar();

     header('Location: /contas');

     exit;
    
  }


  
  /********************************************************************/
  public function excluir()
  {

    $id = (int) filter_input(INPUT_POST, 'idapaga'  , FILTER_DEFAULT); 

    $conta = new ContaModel();

    $conta->id = $id;

    $conta->deletar();

    header('Location: /contas');

    exit;
    
  }


  /****************************************************************/
  public function editar()
  {

     $conta = new ContaModel();

     $conta->id = (int) filter_input(INPUT_POST, 'idedita'  , FILTER_DEFAULT);  // ok
  
     $dado = $conta->findId();   
    
     $lista = [
        'tipos' => tipoConta(),
        'titulo' => 'Alterar Conta',
        'conta' => $dado,
        'urllink' => '/alterarconta'
     ];
    
     printaTela('CadastrarConta.html', $lista);  
    
  }


  /****************************************************************/
  public function atualiza()
  {

     $conta = new ContaModel();
    
     $conta->id         =  filter_input(INPUT_POST, 'idcadastro'  , FILTER_DEFAULT); 

     $conta->descricao  =  strtoupper(filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT));

     $conta->tipo       =  filter_input(INPUT_POST, 'tipo', FILTER_DEFAULT);

     $conta->valor = 0.00;

     $numero = $conta->update();

     header('Location: /contas');

     exit;

  }
  


  
}