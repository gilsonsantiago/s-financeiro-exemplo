<?php

class RelatorioController{


  /*************************************************************/
  public function exibir()
  {

   // $relatorio = New RelatorioModel;

   $saldo = new RelatorioModel;

   $resultado = $saldo->calcularSaldoContas();

   //var_dump($resultado);
   //die();
    
   $resultado = []; // $conta->findAll();

   $lista = array(
     'nomeusuario' => Sessao::getDadosSessao()['nome'],
     'lista' => $resultado
   );
      
    printaTela('Relatorios.html', $lista);   
    
  }

  
  /********************************************************************/
  public function balancete()
  {
 
    if(isset($_POST['balancete']))
    {

         $conta = New ContaModel;  
         $saldo = new RelatorioModel;            
             
         $resultado = $conta->findAll();

         $receitas = $saldo->calcularTotal($resultado)['receitas'];
         $despesas = $saldo->calcularTotal($resultado)['despesas'];
      
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
            
         printaTela('Balancete.html', $lista);
      
    }  

  }


  
  


}