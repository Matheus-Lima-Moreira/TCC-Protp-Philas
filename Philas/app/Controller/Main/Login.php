<?php

namespace App\Controller\Main;

use App\Http\Request;
use App\Model\Entity\User;
use App\Session\Login as SessionLogin;
use App\Utils\View;

class Login extends Page {

  /**
   * Método responsável por retornar o conteúdo (VIEW) do Login
   * 
   * @return  string
   */
  public static function getLogin() {
    // VIEW DO LOGIN
    $content = View::render('login');

    // RENDERIZA VIEW DA PÁGINA
    return parent::getPage('Login', $content, "", "");
  }

  /**
   * Método responsável por definir o login do usuário
   *
   * @param   Request  $request  
   */
  public static function setLogin(Request $request) {
    // POST VARS
    $postVars = $request->getPostVars();
    $usuario  = $postVars['usuario'] ?? '';
    $senha    = $_POST['senha'] ?? '';
    $lembar   = isset($_POST['lembrar']);

    // BUSCA O USUÁRIO PELO LOGIN
    $obUser = User::getUserByLogin($usuario);

    if (!$obUser instanceof User) return self::getLogin(); // FIXME: Custumoziar um retorno?

    // VERIFICA A SENHA DO USUÁRIO
    if (!password_verify($senha, $obUser->senha)) return self::getLogin();

    // CRIA A SESSÃO DE LOGIN
    SessionLogin::login($obUser, $lembar);

    // REDIRECIONA O USUÁRIO PRO DASHBOARD
    $request->getRouter()->redirect('/usuario');
  }


  /**
   * Método reponsável por deslogar o usuário
   *
   * @param   Request  $request  
   */
  public static function setLogout(Request $request) {
    // DESTRÓI A SESSÃO DE LOGIN
    SessionLogin::logout();

    // REDIRECIONA O USUÁRIO PARA A TELA INICIAL
    $request->getRouter()->redirect('/');
  }
}
