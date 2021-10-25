<?php

namespace App\Http\Middleware;

use App\Http\Request;
use Closure;

class Admin implements MiddlewareInterface {

  /**
   * Método responsável por executar o middleware
   *
   * @param   Request  $request  
   * @param   Closure  $next     
   *
   * @return  Closure           
   */
  public function handle(Request $request, Closure $next) {
    // BUSCA PELO USUÁRIO LOGADO
    $userLogged = $request->userLogged ?? $_SESSION['ph_login']['usuario'];

    // VERIFICA SE É UM ADMINISTRADOR
    if (strtoupper($userLogged->tipo) != strtoupper(\App\Model\Entity\User::$tipos['admin']))
      throw new \Exception("Acesso restritro", 403);

    // EXECUTA O PRÓXIMO NÍVEL DO MIDDLEWARE
    return $next($request);
  }
}
