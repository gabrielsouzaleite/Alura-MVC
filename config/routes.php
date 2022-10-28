<?php

use Alura\Cursos\Controller\{Exclusao, FormularioEdicao, FormularioInsercao, FormularioLogin, ListarCursos, Persistencia, RealizarLogin};


return [
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class
];
