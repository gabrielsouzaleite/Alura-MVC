<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{
  use ControllerComHtml;

  private $repositorioDeCursos;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->repositorioDeCursos = $entityManager
      ->getRepository(Curso::class);
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $cursos = $this->repositorioDeCursos->findAll();
    $html = $this->renderizaHtml('cursos/listar-cursos.php', [
      'cursos' => $cursos,
      'titulo' => 'Lista de Cursos'
    ]);

    return new Response(200, [], $html);
  }
}
