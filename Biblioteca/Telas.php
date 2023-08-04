<?php

require_once('vendor/autoload.php');

function printaTela($tela, array $dados = [])
{

    $loader = new \Twig\Loader\FilesystemLoader(URL_VIEWS);

    $twig = new \Twig\Environment($loader);

    echo $twig->render($tela, $dados);
}
