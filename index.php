<?php

require_once('vendor/autoload.php');

require_once('Biblioteca/Conexao.php');
require_once('Biblioteca/Sessao.php');

require_once('App/Controllers/UsuarioController.php');
require_once('App/Controllers/HomeController.php');
require_once('App/Controllers/ContaController.php');
require_once('App/Controllers/MovtoController.php');
require_once('App/Controllers/RelatorioController.php');

require_once('App/Models/UsuarioModel.php');
require_once('App/Models/ContaModel.php');
require_once('App/Models/MovtoModel.php');
require_once('App/Models/RelatorioModel.php');

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


//require_once('Outros/CriarUsuario.php');
//require_once('Outros/CriarContas.php');
//require_once('Outros/CriarMovimento.php');
//require_once('Outros/Migracao.php');

//die();


Sessao::sessaoInit();

if(isset($_SESSION['user_id']))
{

  $user = $_SESSION['user_id']['nome'];
  
}  
else
{

  $user = 'Não Logado...';
  
}  

$lista = [
         'nomeusario' => Sessao::getDadosSessao()['nome']
       ];

$dadosusuario = array(
  'nomeusuario' => $user
);


/******************** ROTAS  *********************************/
switch($url)
{

  /**************************** HOME - MURAL  ********************************************/
  case '/':  
     printaTela('Home.html', $dadosusuario); 
     break;

  /**************************** CADASTRP DE USUARIOS ***********************************************/ 
  case '/login':  
   if(!Sessao::isLogado())
   {
     $usa = new UsuarioController;  
     $usa->login();       
   }    
   else
   {
            
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário Logado com Sucesso...'], $lista);
   }  
   break;

  case '/logarusuario':
     $usa = new UsuarioController;  
     $usa->logar();  
     break;
  

   case '/listarusuario':  
    if(Sessao::isLogado())
    {
       $usa = new UsuarioController;  
       $usa->exibir();       
    }
    else
    {
       printaTela('AlertaDanger.html', ['mensagem' => 'Usuário não Logado...'], $lista);
    }    
    break;  

  case '/cadastrar':  
     $usa = new UsuarioController;  
     $usa->cadastrar();
     break;   

  case '/cadastrarnovo':  
     $usa = new UsuarioController;  
     $usa->cadastraInicial();
     break;   

  case '/salvarusuario':
     $usa = new UsuarioController;
     $usa->gravar();
     break;

  case '/excluirusuario':
     $usa = new UsuarioController;
     $usa->excluir(); 
     break;

  case '/editarusuario':
     $usa = new UsuarioController;
     $usa->editar();  
     break;

  case '/atualizarusuario':
     $usa = new UsuarioController;
     $usa->atualiza();
     break;

  case '/usuariologout':
     $usa = new UsuarioController;
     $usa->logout();
     break;  


   /***************************** CADASTRO DE CONTAS *****************************************************/
   case '/contas':  

   if(Sessao::isLogado())
   {
      $cta = new ContaController;
      $cta->exibir();  
   }
   else
   {
       printaTela('AlertaDanger.html', ['mensagem' => 'Usuário não Logado...'], $lista);
   }  
   break;

  case '/cadastrarcontas':
    $cta = new ContaController;
    $cta->cadastrar();
    break;  

  case '/salvarconta':
    $cta = new ContaController;
    $cta->gravar();
    break;  

  case '/excluirconta':
    $cta = new ContaController;
    $cta->excluir();
    break; 

   case '/editarconta':
    $cta = new ContaController;
    $cta->editar();
    break; 

  case '/alterarconta':
    $cta = new ContaController;
    $cta->atualiza();
    break; 

   default:  
     echo 'Erro 404 - Página não existe';  
     break;



  /***************************** LANÇAMENTOS DE CONTAS *****************************************************/
   case '/movto':  
     if(Sessao::isLogado())
     {
        $movto = new MovtoController;
        $movto->exibir();  
     }
     else
     {
        printaTela('AlertaDanger.html', ['mensagem' => 'Usuário não Logado...'], $lista);
     }  
     break;

  
  case '/cadastrarmovtos':  
   if(Sessao::isLogado())
   {
      $movto = new MovtoController;
      $movto->cadastrar();  
   }
   else
   {
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
   }  
   break;

  
  case '/salvarmovto':
   if(Sessao::isLogado())
   {
      $movto = new MovtoController;
      $movto->gravar();  
   }
   else
   {
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
   }  
   break;

  case '/excluirmovto':
   if(Sessao::isLogado())
   {
      $movto = new MovtoController;
      $movto->excluir();  
   }
   else
   {
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
   }  
   break;

  case '/editarmovto':
   if(Sessao::isLogado())
   {
      $movto = new MovtoController;
      $movto->editar();  
   }
   else
   {
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
   }  
   break;

  case '/alterarmovto':
   if(Sessao::isLogado())
   {
      $movto = new MovtoController;
      $movto->atualiza();  
   }
   else
   {
       printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
   }  
   break;


  /***************************** RELATORIOSE DEMONSTRATIVOS *****************************************************/
   case '/relatorios':  
     if(Sessao::isLogado())
     {
        $movto = new RelatorioController;
        $movto->exibir();  
     }
     else
     {
         printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
     }  
     break;

   case '/demonstrativo':  
     if(Sessao::isLogado())
     {
        $movto = new RelatorioController;
        $movto->balancete();  
     }
     else
     {
         printaTela('AlertaSucess.html', ['mensagem' => 'Usuário não esta Logado...'], $lista);
     }  
     break;

  
}