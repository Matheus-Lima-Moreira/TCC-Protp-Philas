<?php

use \App\Controller\Api;
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
