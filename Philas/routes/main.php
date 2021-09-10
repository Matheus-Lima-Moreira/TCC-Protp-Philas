<?php

use \App\Controller\Main;
use \App\Http\Response;

// ROTA HOME
$obRouter->get('/', [
  function () {
    return new Response(200, Main\Home::getHome());
  }
]);

// ROTA DE LOGIN
$obRouter->get('/login', [
  'middlewares' => [
    'required-logout'
  ],
  function () {
    return new Response(200, Main\Login::getLogin());
  }
]);

// ROTA DE LOGIN (POST)
$obRouter->post('/login', [
  'middlewares' => [
    'required-logout'
  ],
  function ($request) {
    return new Response(200, Main\Login::setLogin($request));
  }
]);

// ROTA DE LOGOUT
$obRouter->get('/logout', [
  'middlewares' => [
    'required-login'
  ],
  function ($request) {
    return new Response(200, Main\Login::setLogout($request));
  }
]);
