<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
  http_response_code(404);
  exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
  $psr17Factory, // ServerRequestFactory
  $psr17Factory, // UriFactory
  $psr17Factory, // UploadedFileFactory
  $psr17Factory  // StreamFactory
);

$reques = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];
$container = require __DIR__ . '/../config/dependecies.php';
$controlador = $container->get($classeControladora);
$controlador->processaRequisicao();
