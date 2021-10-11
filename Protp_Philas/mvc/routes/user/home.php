<?php

use App\Controller\User;
use App\Http\Request;
use App\Http\Response;

// ROTA HOME
$obRouter->get('/usuario', [
  function () {
    return new Response(200, User\Main::getHome());
  }
]);

// ROTA DE CADASTRO
$obRouter->get('/singup', [
  'middlewares' => [
    'required-logout'
  ],
  function () {
    return new Response(200, User\Main::getNewUser());
  }
]);

// ROTA DE CADASTRO (POST)
$obRouter->post('/singup', [
  'middlewares' => [
    'required-logout'
  ],
  function (Request $request) {
    return new Response(200, User\Main::setNewUser($request));
  }
]);
