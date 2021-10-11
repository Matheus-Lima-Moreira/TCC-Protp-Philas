<?php

require_once(__DIR__ . '/../composer/vendor/autoload.php');

use App\Http\Middleware\Queue as MiddlewareQueue;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Database;
use WilliamCosta\DotEnv\Environment;

// CARREGA VARIÁVEIS DE AMBIENTE
Environment::load(__DIR__ . "/../");

// DEFINE AS CONFIGURAÇÕES DE BANCO DE DADOS
Database::config(
  getenv('DB_HOST'),
  getenv('DB_NAME'),
  getenv('DB_USER'),
  getenv('DB_PASS'),
  getenv('DB_PORT')
);

// DEFNIE A CONSTANTE DE URL DO PROJETO
$scheme = $_SERVER['REQUEST_SCHEME'];
$domain = $_SERVER['SERVER_NAME'];
$port   = $_SERVER['SERVER_PORT'];
$root   = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

define('URL', "$scheme://$domain:$port$root");

// DEFININE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
  'URL' => URL
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES PADRÕES (EXECUTADOS EM TODAS AS ROTAS)
MiddlewareQueue::setDefault([
  'maintenance'
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
  'maintenance'     => \App\Http\Middleware\Maintenance::class,
  'required-login'  => \App\Http\Middleware\RequireLogin::class,
  'required-logout' => \App\Http\Middleware\RequireLogout::class,
  'api'             => \App\Http\Middleware\Api::class,
  'api-auth'        => \App\Http\Middleware\ApiAuth::class,
  'admin'           => \App\Http\Middleware\Admin::class,
]);

// DEFINE MIDDLEWARES PADRÕES POR ROTAS
MiddlewareQueue::setDefaultPerRoutes([
  'usuario'          => ['required-login'],
  'api'              => [-1 => 'api'],
  'api\/v1\/reasons' => ['api-auth'],
]);
