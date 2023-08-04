<?php
/***********************************************/
function situacao()
{
  
  return (array(
       ['indice' => 1, 'descricao' => 'Ativo'], 
       ['indice' => 2, 'descricao' => 'Inativo'],
       ['indice' => 3, 'descricao' => 'Administrador']
     ));
}


/***********************************************/
function tipoConta()
{
  
  return (array(
       ['indice' => 1, 'descricao' => 'Receita'], 
       ['indice' => 2, 'descricao' => 'Despesa']
     ));
}


/***********************************************/
function tipoOperacao()
{
  
  return (array(
       ['indice' => 1, 'descricao' => 'Credito'], 
       ['indice' => 2, 'descricao' => 'Debito']
     ));
}




/**********************************************/
function dd($param)
{
   echo '<p>';
    print_r($param);
   echo '</p>';
   die();
}  