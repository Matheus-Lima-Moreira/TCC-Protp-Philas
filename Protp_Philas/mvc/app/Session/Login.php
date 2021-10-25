<?php

namespace App\Session;

use App\Model\Entity\User as EntityUser;
use Firebase\JWT\JWT;

class Login {

  /**
   * Método responsável por iniciar a sessão
   */
  private static function init() {
    // VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
  }

  /**
   * Método responsável por criar o login do usuário
   *
   * @param   EntityUser    $obUser
   * @param   boolean       $remember 
   *
   * @return  boolean        
   */
  public static function login(Object $obUser, bool $remember = false): bool {
    // INICIA A SESSÃO
    self::init();

    // DEFINE A SESSÃO DO USUÁRIO
    $_SESSION['ph_login']['usuario'] = $obUser;

    // DEFINE O TOKEN EM COOKIES
    $payload = [
      'id'    => $obUser->id,
      'login' => $obUser->login
    ];

    // ENCODA O TOKEN
    $jwt = JWT::encode($payload, getenv('JWT_KEY'));

    // SALVA NOS COOKIES DE SESSÃO OU POR UM ANO
    setcookie('ph_login-token', $jwt, $remember ? time() + 86400 * 365 : 0, '/');

    // SUCESSO
    return true;
  }

  /**
   * Método reponsável por verificar se o usuário está logado
   *
   * @return  boolean
   */
  public static function isLogged(): bool {
    // INICIA A SESSÃO
    self::init();

    // BUSCA PELA SESSÃO DO USUÁRIO
    $return = isset($_SESSION['ph_login']['usuario']);

    // BUSCA POR TOKEN NOS COOKIES
    if (!$return && isset($_COOKIE['ph_login-token'])) {
      // VERIFICA SE O TOKEN É VÁLIDO
      try {
        // DECODE
        $jwt = JWT::decode($_COOKIE['ph_login-token'], getenv('JWT_KEY'), ['HS256']);

        // VALIDA OS DADOS FORNECIDOS NO JWT
        $obUser = EntityUser::getUserByLogin($jwt->login);
        if (!$obUser->isValidToken($jwt)) throw new \Exception();

        // RENOVA O LOGIN
        self::login($jwt, true);

        // ESTÁ LOGADO
        return true;
      } catch (\Exception $e) {
        throw new \Exception("Token inválido", 403); // TODO: Gerar algum erro interno ou ao usuario
      }
    }

    // RETORNA A VERIFICAÇÃO
    return $return;
  }

  /**
   * Método reponsável por executar o logout do usuário
   *
   * @return  boolean
   */
  public static function logout(): bool {
    // INICIA A SESSÃO
    self::init();

    // DESLOGA O USUÁRIO
    unset($_SESSION['ph_login']['usuario']);
    setcookie('ph_login-token', '', 1, '/');

    // SUCESSO
    return true;
  }
}
