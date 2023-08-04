<?php

class Home{

    public function home(){

         $lista = [
            'nomeusuario' =>  Sessao::getDadosSessao()['nome']
         ];

         printaTela('Home.html', $lista); 
      
    }

  
}