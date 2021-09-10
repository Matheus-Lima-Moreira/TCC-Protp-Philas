<?php

use \App\Controller\Api;
use \App\Http\Request;
use \App\Http\Response;

// ROTA RAIZ DA API (v1)
$obRouter->get('/api/v1', [
  'middleware' => [
    'api'
  ],
  function () {
    return new Response(200, Api\Api::getDetails(), 'application/json');
  }
]);

// ROTA PARA GERAR AUTORIZAÇÃO PARA API
$obRouter->post('/api/v1/auth', [
  'middlewares' => [
    'api'
  ],
  function (Request $request) {
    return new Response(200, Api\Api::genarateToken($request), 'application/json');
  }
]);
