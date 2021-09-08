<?php

use \App\Controller\Api;
use \App\Http\Request;
use \App\Http\Response;

// ROTA DE LISTAGEM DE TODOS OS USUÁRIOS
$obRouter->get('/api/v1/users', [
  'middlewares' => [
    'api',
    'api-auth'
  ],
  function (Request $request) {
    return new Response(200, Api\User::getUsers($request), 'application/json');
  }
]);

// ROTA DE CONSULTA DO USUÁRIO ATUAL
$obRouter->get('/api/v1/users/me', [
  'middlewares' => [
    'api',
    'api-auth'
  ],
  function (Request $request) {
    return new Response(200, Api\User::getCurrentUser($request), 'application/json');
  }
]);

// ROTA DE CONSULTA INDIVIDUAL DE USUÁRIOS
$obRouter->get('/api/v1/users/{id}', [
  'middlewares' => [
    'api',
    'api-auth'
  ],
  function ($id) {
    return new Response(200, Api\User::getUser($id), 'application/json');
  }
]);

// ROTA DE CADASTRO DE USUÁRIOS
$obRouter->post('/api/v1/users', [
  'middlewares' => [
    'api',
    'api-auth'
  ],
  function (Request $request) {
    return new Response(201, Api\User::setNewUser($request), 'application/json');
  }
]);

// ROTA DE ATUALIZAÇÃO INDIVIDUAL DE USUÁRIOS
$obRouter->put('/api/v1/users/me', [
  'middlewares' => [
    'api',
    'api-auth'
  ],
  function (Request $request) {
    return new Response(201, Api\User::setEditCurrentUser($request), 'application/json');
  }
]);
