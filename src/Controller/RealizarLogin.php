<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
  /**
   * @var \Doctrine\Common\Persistence\ObjectRepository
   */
  private $repositorioDeUsuarios;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->repositorioDeUsuarios = $entityManager
      ->getRepository(Usuario::class);
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $email = filter_input(
      INPUT_POST,
      'email',
      FILTER_VALIDATE_EMAIL
    );

    if (is_null($email) || $email === false) {
      echo "O e-mail digitado não é um e-mail válido.";
      return;
    }

    $senha = filter_input(
      INPUT_POST,
      'senha',
      FILTER_SANITIZE_STRING
    );

    /** @var Usuario $usuario */
    $usuario = $this->repositorioDeUsuarios
      ->findOneBy(['email' => $email]);

    if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
      echo "E-mail ou senha inválidos";
      return;
    }
    $resposta = new Response(302, ['Location' => '/listar-cursos']);
    return $resposta;
  }
}
