<?php

namespace App\Session;

use \App\Model\Entity\User;
use \Firebase\JWT\JWT;

// TODO: add remember me
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
   * @param   User    $obUser
   * @param   boolean $remember 
   *
   * @return  boolean        
   */
  public static function login(Object $obUser, bool $remember = false) {
    // INICIA A SESSÃO
    self::init();

    // DEFINE A SESSÃO DO USUÁRIO
    $_SESSION['ph_login']['usuario'] = [
      'id'    => $obUser->id,
      'nome'  => $obUser->nome,
      'email' => $obUser->email
    ];

    // DEFINE O TOKEN EM COOKIES
    if ($remember) self::remember($obUser);

    // SUCESSO
    return true;
  }

  /**
   * Método responsável por gerar um token JWT e salvar
   *
   * @param   User  $obUser  
   */
  private static function remember(Object $obUser) {
    // PAYLOAD
    $payload = [
      'id'    => $obUser->id,
      'nome'  => $obUser->nome,
      'email' => $obUser->email
    ];

    // ENCODA E SALVA NOS COOKIES POR UM ANO
    $jwt = JWT::encode($payload, getenv('JWT_KEY'));
    setcookie('ph_login-token', $jwt, time() + 86400 * 365, "/");
  }

  /**
   * Método reponsável por verificar se o usuário está logado
   *
   * @return  boolean
   */
  public static function isLogged() {
    // INICIA A SESSÃO
    self::init();

    // BUSCA POR TOKEN NOS COOKIES
    if (isset($_COOKIE['ph_login-token'])) {
      // VERIFICA SE O TOKEN É VÁLIDO
      try {
        // DECODE
        $jwt = JWT::decode($_COOKIE['ph_login-token'], getenv('JWT_KEY'), ['HS256']);

        // RENOVA O LOGIN
        self::login($jwt, true);

        // ESTÁ LOGADO
        return true;
      } catch (\Exception $e) {
        // throw new \Exception("Token inválido", 403); // FIXME: Gerar algum erro interno ou usuario
      }
    }

    // RETORNA A VERIFICAÇÃO
    return isset($_SESSION['ph_login']['usuario']['id']);
  }

  /**
   * Método reponsável por executar o logout do usuário
   *
   * @return  boolean
   */
  public static function logout() {
    // INICIA A SESSÃO
    self::init();

    // DESLOGA O USUÁRIO
    unset($_SESSION['ph_login']['usuario']);
    setcookie('ph_login-token', '', 1, '/');

    // SUCESSO
    return true;
  }
}
