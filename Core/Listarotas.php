<?php

 function show()
  {

      switch($url)
      {
      
          case '/':
              echo 'Página Inicial';
              break;
          case '/teste':
              echo 'Página de Teste';
              break;
          default:
              echo 'Erro 404 - Página não existe';
              break;
      }
    
  }