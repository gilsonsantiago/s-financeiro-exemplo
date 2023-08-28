<?php

class RelatorioController{


  /*************************************************************/
  public function exibir()
  {

   $lista = array(
     'nomeusuario' => Sessao::getDadosSessao()['nome']
   );
      
    printaTela('Relatorios.html', $lista);   
    
  }

  
  /********************************************************************/
  public function balancete()
  {


    $conta = New ContaModel;  
    $saldo = new RelatorioModel;            
             
    $resultado = $conta->findAll();
 
    if(isset($_POST['balancete']))
    {

         $saldo->calcularSaldoContas();
      
         $receitas = $saldo->calcularTotal($resultado)['receitas'];
         $despesas = $saldo->calcularTotal($resultado)['despesas'];
      
         $caixa      = ($receitas - $despesas);
         $totalgeral = $receitas;
      
         $lista = array(
           'nomeusuario'   => Sessao::getDadosSessao()['nome'],
           'totalreceitas' => $receitas,
           'totaldespesas' => $despesas,
           'saldoemcaixa'  => $caixa,
           'totalgeral'    => $totalgeral,
           'lista'         => $resultado
         );
            
         printaTela('Balancete.html', $lista);
      
    }  
    elseif (isset($_POST['balancetemensal']))
    {

         $data = filter_input(INPUT_POST, 'datapublica', FILTER_DEFAULT);
              
         $resultado = $saldo->calcularSaldoContasMensal($data);

         die();
     
         $receitas = $saldo->calcularTotal($resultado, $data)['receitas'];
         $despesas = $saldo->calcularTotal($resultado, $data)['despesas'];
      
         $caixa      = ($receitas - $despesas);
         $totalgeral = $receitas;
      
         $lista = array(
           'nomeusuario'   => Sessao::getDadosSessao()['nome'],
           'totalreceitas' => $receitas,
           'totaldespesas' => $despesas,
           'saldoemcaixa'  => $caixa,
           'totalgeral'    =>  $totalgeral,
           'lista'         => $resultado
         );
            
         printaTela('BalanceteMensal.html', $lista);
      
    }     

  }


  


}