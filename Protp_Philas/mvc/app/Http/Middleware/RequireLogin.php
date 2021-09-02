<?php

namespace App\Http\Middleware;

use \App\Http\Request;
use \App\Http\Response;
use \App\Session\Login as SessionLogin;
use \Closure;

class RequireLogin {

  /**
   * Método responsável por executar o middleware
   *
   * @param   Request  $request  
   * @param   Closure  $next     
   *
   * @return  Response           
   */
  public function handle(Request $request, Closure $next) {
    // VERIFICA SE O USUÁRIO ESTÁ LOGADO
    if (!SessionLogin::isLogged()) $request->getRouter()->redirect(''); // FIXME: Retonar pra uma página certa

    // CONTINUA A EXECUÇÃO
    return $next($request);
  }
}
