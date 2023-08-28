<?php



class RelatorioModel{

  /***********************************************/
  public function calcularSaldoContas()
  {

     $db = Conexao::conectar();  

     $id_uso = (int) Sessao::getDadosSessao()['id'];

     $dados = [];

     $contas = $db->query("SELECT * FROM contas");  

     $resultadocontas = $db->query("SELECT movimento.id,
                                              movimento.id_usuario,
                                              movimento.id_conta,
                                              movimento.opera,
                                              movimento.data,
                                              movimento.valor,
                                         SUM (movimento.valor) AS saldo
                                        FROM  movimento
                                       WHERE  movimento.id_usuario = {$id_uso}
                                    GROUP BY  movimento.id_conta");              
 
        foreach ($resultadocontas->fetchAll() as $key => $value)
        {

           $contaatualiza = new ContaModel();
          
           $contaatualiza->id    = (int) $value['id_conta'];
           $contaatualiza->saldo = $value['saldo'];

           $contaatualiza->updateSaldo();
         
        }  
   
       return '';
    
   }



  
  /***********************************************/
  public function calcularTotal($dados)
  {
  
     $totalreceita = 0.00;
     $totaldespesa = 0.00;

     for($i = 0; $i < count($dados); $i++)
     {

        if($dados[$i]['tipo'] == 1)
        {
            $totalreceita = $totalreceita + $dados[$i]['saldo'];
        } 
        else
        {
            $totaldespesa = $totaldespesa + $dados[$i]['saldo'];
        }  
       
      }  

     return ([
             'receitas' => $totalreceita, 
             'despesas' => $totaldespesa
             ]);    
    
  }


  
  
 /*********************************************************************/
  public function calcularSaldoContasMensal($data)
  {

   //   $db = Conexao::conectar();  

   //   $id_uso = (int) Sessao::getDadosSessao()['id'];

   //   $dados = [];

   // //  $contas = $db->query("SELECT * FROM contas");  

     

   //   $resultadocontas = $db->query("SELECT movimento.id,
   //                                         movimento.id_usuario,
   //                                         movimento.id_conta,
   //                                         movimento.opera,
   //                                         movimento.data,
   //                                         movimento.valor                                    
   //                                   FROM  movimento
   //                                  WHERE  movimento.id_usuario = {$id_uso}
   //                                 ");              


   //       $tam = count($contas->fetchAll());

   //       echo $tam;

   //       $contas = new ContaModel;
   //       $resultado = $contas->findAll();

   //       dd($resultado);

   //      die();
         
    
    
        // for($i = 0; $i < $tam; $i++)
        // {
        //     echo $i . '<br>';
        // }  
          //     echo $cta['descricao'] . '<br>';

          //     foreach ($resultadocontas->fetchAll() as $key => $value)
          //     {
      
          //       if((getAno($data) == getAno($value['data'])) && ( getMes($data) == getMes($value['data']))) 
          //       {
      
          //           echo  $cta['descricao'] . '-' .$data . ' ... é da competencia  de ' . $value['data'] . '<br>';
                  
          //       }  
          //       else
          //       {
      
          //           echo  $data . ' ... NÃO é da competencia  de ' . $value['data'] . '<br>';            
                  
          //       }  
              
          //     }   
           
          // }  

//          for($i = 0; $i < count())
    
   
           
   
    
    /*
           $contaatualiza = new ContaModel();
          
           $contaatualiza->id    = (int) $value['id_conta'];
           $contaatualiza->saldo = $value['saldo'];

           $contaatualiza->updateSaldo();
         
        }  

      */
        
 
   
       return '';
    
 }


  /****************************************************************************/
  public function verificaData($data, $databanco)
  {

       
  }


  
}