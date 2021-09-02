<?php

require_once(__DIR__ . '\\includes\\app.php');

use \App\Http\Router;

// INICIA O ROTEADOR
$obRouter = new Router(URL);

// INCLUI AS ROTAS DAS PÁGINAS PRINCIPAIS
include(__DIR__ . '\\routes\\main.php');

// INCLUI AS ROTAS DAS PÁGINAS DO USUÁRIO (?)
include(__DIR__ . '\\routes\\user.php');

// INCLUI AS ROTAS DASP APIS
include(__DIR__ . '\\routes\\api.php');

// IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();
