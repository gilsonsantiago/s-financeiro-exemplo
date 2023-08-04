<?php

class UsuarioController{

  /*************************************************************/
  public function exibir()
  {

   $usuario = New UsuarioModel;
    
   $usuario->id =  (int) Sessao::getDadosSessao()['id'];   
   $status      =  (int) Sessao::getDadosSessao()['status']; 

    // echo $status . '<br>';
    // echo Sessao::getDadosSessao()['nome']  . '<br>'; 
    // echo Sessao::getDadosSessao()['id']. '<br>'; 
    // die(); 

   $resultado = [];
    
   if($status == 3)
   {
     $resultado = $usuario->findAll();
   } 
   else
   {
     
     $usu = $usuario->findId();

     $resultado = [ array (
       'id' => $usu['id'],
                    'nome' => $usu['nome'],
                    'login' => $usu['login'],
                    'senha' => '',
                    'status' => $usu['status']
                   )                    
                 ];
     
   }  

  // echo count($resultado) . '<br>';

  // var_dump($resultado); 

  // die(); 

   $lista = array(
     'nomeusuario' => Sessao::getDadosSessao()['nome'],
     'lista' => $resultado,
     'adm' => ADM
   );
   
    printaTela('Listarusuarios.html', $lista);   
    
  }


  
  /***********************************************************/
  public function login()
  {

     $lista = [
       'nomeusuario' => Sessao::getDadosSessao()['nome']
     ];
    
     printaTela('Login.html', $lista);  
    
  }


  
  /***********************************************************/
  public function logar()
  {

     $usuario = new UsuarioModel();
 
     $usuario->login  = strtoupper(trim(filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT)));
     $usuario->senha  = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

     $resultado = $usuario->findLogin();

     $usuariologado = [];

     foreach ($resultado as $usu)
     {

         if($usuario->login == $usu['login'])
         {
           
             $usuariologado =  $usu;  

             break;      

         }  
                 
     }  

     if(count($usuariologado) > 0)
     {

       if (password_verify($usuario->senha, $usuariologado['senha']))
       {
    
           $usuariologado['senha'] = '';  // Limpar a senha para não gravar na sessão

            Sessao::logarUsuario($usuariologado);
         
            printaTela('AlertaSucess.html', [
                       'mensagem' => 'Usuário Logado com Sucesso...', 
                       'nomeusuario' => Sessao::getDadosSessao()['nome']
                       ]);
               
       }  
       else
       {

            printaTela('AlertaDanger.html', [
                       'mensagem' => 'Dados informados inválidos...',
                       'nomeusuario' => Sessao::getDadosSessao()['nome']
                       ]); 

            exit;
         
       }  
       
     }  
     else
     {

         printaTela('AlertaDanger.html', [
                    'mensagem' => 'Usuário não Cadastrado...',
                    'nomeusuario' => Sessao::getDadosSessao()['nome']
                    ]);    
       
         exit;
       
     }  
    
    
  }


  
  /*************************************************************/
  public function logout()
  {

      Sessao::logarOut();

      header('Location: /listarusuario'); 

      exit;
    
  }


  
  /****************************************************************/
  public function cadastrar()
  {

     $usuario = new UsuarioModel();
     
     $lista = [
        'situacao' => situacao(),
        'nomeusuario' => Sessao::getDadosSessao()['nome'],
        'usuario' => $usuario,
        'titulo' => 'Cadastrar Novo Usuário',
        'urllink' => '/salvarusuario'
     ];

     $status = (int) Sessao::getDadosSessao()['status'];

     ($status == 3) 
      ? printaTela('Cadastrar.html', $lista) 
      : printaTela('AlertaDanger.html', [
                   'mensagem' => 'Usuário não autorizado...',
                   'nomeusuario' => Sessao::getDadosSessao()['nome']
                   ]);   
    
  }


  /****************************************************************/
  public function cadastraInicial()
  {

     $usuario = new UsuarioModel();
     
     $lista = [
        'situacao' => situacao(),
        'nomeusuario' => Sessao::getDadosSessao()['nome'],
        'usuario' => $usuario,
        'titulo' => 'Cadastrar Novo Usuário',
        'urllink' => '/salvarusuario'
     ];

     $status = (int) Sessao::getDadosSessao()['status'];
    
     printaTela('Cadastrar.html', $lista); 
    
    
  }
  
  /****************************************************************/
  public function gravar()
  {
  
     $senha     = filter_input(INPUT_POST, 'senha'  , FILTER_DEFAULT); 
    
     $novasenha = password_hash(trim($senha), PASSWORD_DEFAULT);
    
     $usuario = new UsuarioModel();
    
     $usuario->nome   = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    
     $usuario->login  = strtoupper(trim(filter_input(INPUT_POST, 'login', FILTER_DEFAULT)));
    
     $usuario->senha  = $novasenha;
    
     $usuario->status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);

     //dd($usuario);

     $numero = $usuario->salvar();

    // dd($numero);

     header('Location: /listarusuario');

    exit;
    
  }

  

  /****************************************************************/
  public function editar()
  {

     $usuario = new UsuarioModel();

     $usuario->id = (int) filter_input(INPUT_POST, 'idedita'  , FILTER_DEFAULT);  // ok
  
     $dado = $usuario->findId();     
            
     $lista = [
        'situacao' => situacao(),
        'nomeusuario' => Sessao::getDadosSessao()['nome'],
        'usuario' => $dado,
        'titulo' => 'Alterar Usuário',
        'urllink' => '/atualizarusuario'
     ];

     $status = (int) Sessao::getDadosSessao()['status'];

     ($status == 3) 
      ? printaTela('Cadastrar.html', $lista) 
      : printaTela('AlertaDanger.html', [
                   'mensagem' => 'Usuário não autorizado...',
                   'nomeusuario' => Sessao::getDadosSessao()['nome']
                   ]);   
     
    
  }


  /****************************************************************/
  public function atualiza()
  {
 
     $senha     = filter_input(INPUT_POST, 'senha'  , FILTER_DEFAULT);     
     $novasenha = password_hash(trim($senha), PASSWORD_DEFAULT);
    
     $usuario = new UsuarioModel();

     $usuario->id     = filter_input(INPUT_POST, 'idedita', FILTER_DEFAULT);    
     $usuario->nome   = filter_input(INPUT_POST, 'nome'   , FILTER_DEFAULT);  
     $usuario->status = filter_input(INPUT_POST, 'status' , FILTER_DEFAULT); 
    
     $usuario->login  = strtoupper(filter_input(INPUT_POST, 'login', FILTER_DEFAULT)); 
    
     $usuario->senha  = $novasenha;    

     $usuario->update();

     header('Location: /listarusuario');

     exit;
    
  }

  
  /********************************************************************/
  public function excluir()
  {

    $id = (int) filter_input(INPUT_POST, 'idapaga'  , FILTER_DEFAULT); 

    $status = (int) Sessao::getDadosSessao()['status'];

    if($status == 3)
    {

      $usuario = new UsuarioModel();
  
      $usuario->id = $id;
  
      $usuario->deletar(); 


      header('Location: /listarusuario');
  
      exit;
      
    }  
    else
    {

      printaTela('AlertaDanger.html', [
                 'mensagem' => 'Usuário não autorizado...',
                 'nomeusuario' => Sessao::getDadosSessao()['nome']
                 ]);  
      
    }      
    
    
  }

}