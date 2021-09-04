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
