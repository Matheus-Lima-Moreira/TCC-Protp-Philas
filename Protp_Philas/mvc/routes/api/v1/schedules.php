<?php

use App\Controller\Api;
use App\Http\Request;
use App\Http\Response;

// ROTA DE LISTAGEM DE TODOS OS ATENDIMENTOS
$obRouter->get('/api/v1/schedules', [
  'middlewares' => [
    'api-auth',
    'admin'
  ],
  function (Request $request) {
    return new Response(200, Api\Schedule::getSchedules($request), 'application/json');
  }
]);

// ROTA DE LISTAGEM DE TODOS OS ATENDIMENTOS DO USUÁRIO LOGADO
$obRouter->get('/api/v1/schedules/my', [
  'middlewares' => [
    'api-auth'
  ],
  function (Request $request) {
    return new Response(200, Api\Schedule::getMySchedules($request), 'application/json');
  }
]);

// ROTA DE LISTAGEM INDIVIDUAL DE ATENDIMENTOS
$obRouter->get('/api/v1/schedules/{id}', [
  'middlewares' => [
    'api-auth',
    'admin'
  ],
  function ($id) {
    return new Response(200, Api\Schedule::getSchedule($id), 'application/json');
  }
]);

// ROTA DE LISTAGEM DE HORÁRIOS OCUPADOS
$obRouter->get('/api/v1/schedules/occupied', [
  'middlewares' => [
    'api-auth'
  ],
  function (Request $request) {
    return new Response(200, Api\Schedule::getOccupiedHours($request), 'application/json');
  }
]);

// ROTA DE CADASTRO DOS ATENDIMENTOS
$obRouter->post('/api/v1/schedules', [
  'middlewares' => [
    'api-auth'
  ],
  function (Request $request) {
    return new Response(201, Api\Schedule::setNewSchedule($request), 'application/json');
  }
]);

// ROTA DE ATUALIZAÇÃO DE ATENDIMENTOS
$obRouter->put('/api/v1/schedules/{id}', [
  'middlewares' => [
    'api-auth'
  ],
  function (Request $request, $id) {
    return new Response(200, Api\Schedule::setEditSchedule($request, $id), 'application/json');
  }
]);

// ROTA DE ATUALIZAÇÃO DE ATENDIMENTOS
$obRouter->delete('/api/v1/schedules/{id}', [
  'middlewares' => [
    'api-auth',
    'admin'
  ],
  function ($id) {
    return new Response(200, Api\Schedule::setDeleteSchedule($id), 'application/json');
  }
]);
