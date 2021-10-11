<?php

use App\Controller\User;
use App\Http\Response;

// ROTA MINHA CONTA (ALTERAÇÃO)
$obRouter->get('/usuario/minhaConta', [
   'middlewares' => [
       'required-login'
   ],
   function () {
       return new Response(200, User\MyAccount::getMyAccount() );
  }
]);

// ROTA MINHA CONTA (POST)


?>