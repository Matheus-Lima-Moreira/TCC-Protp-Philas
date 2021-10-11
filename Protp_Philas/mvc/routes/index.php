<?php

use App\Controller\Index;
use App\Http\Request;
use App\Http\Response;

// ROTA HOME
$obRouter->get('/', [
  function () {
    return new Response(200, Index\Home::getHome());
  }
]);

// ROTA DE LOGIN
$obRouter->get('/login', [
  'middlewares' => [
    'required-logout'
  ],
  function (Request $request) {
    return new Response(200, Index\Login::getLogin($request));
  }
]);

// ROTA DE LOGIN (POST)
$obRouter->post('/login', [
  'middlewares' => [
    'required-logout'
  ],
  function (Request $request) {
    return new Response(200, Index\Login::setLogin($request));
  }
]);

// ROTA DE LOGOUT
$obRouter->get('/logout', [
  'middlewares' => [
    'required-login'
  ],
  function (Request $request) {
    return new Response(200, Index\Login::setLogout($request));
  }
]);
