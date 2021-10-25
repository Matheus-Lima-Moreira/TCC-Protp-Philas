<?php

use App\Controller\User\Schedules;
use App\Http\Request;
use App\Http\Response;

// ROTA AGENDAMENTO (AGENDAR)
$obRouter->get('/usuario/agendamento', [
  'middlewares' => [],
  function (Request $request) {
    return new Response(200, Schedules\Schedule::getNewSchedules($request));
  }
]);

// ROTA AGENDAMENTO (POST)
$obRouter->post('/usuario/agendamento', [
  'middlewares' => [],
  function (Request $request) {
    return new Response(200, Schedules\Schedule::setNewSchedules($request));
  }
]);
