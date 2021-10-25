<?php

use App\Controller\User;
use App\Http\Request;
use App\Http\Response;

// ROTA HISTÓRICO
$obRouter->get('/usuario/historico', [
  'middlewares' => [
    'required-login'
  ],
  function (Request $request) {
    return new Response(200, User\Schedules\Historic::getHistoric($request));
  }
]);
