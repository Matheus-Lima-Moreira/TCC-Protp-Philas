<?php

namespace App\Controller\User;

use App\Http\Request;
use App\Model\Entity\User as EntityUser;
use App\Session\Login as SessionLogin;
use App\Utils\View;

class Main extends Page {

  /**
   * Método responsável por retornar o conteúdo (VIEW) da Home
   *
   * @return  string  
   */
  public static function getHome() {
    // VIEW DA HOME
    $content =  View::render('user/home');

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('Início', $content);
  }

  /**
   * Método responsável por retornar o formuário de cadastro
   * 
   * @return  string            
   */
  public static function getNewUser() {
    // CONTEÚDO DO FORMULÁRIO
    $content = View::render('user/form', [
      'title_form' => 'Preencha com seus dados',
      'name'       => '',
      'lastname'   => '',
      'phone'      => '',
      'cpf'        => '',
      'user'       => '',
      'email'      => '',
      'action'     => 'Confirmar'
    ]);

    // RETORNAR A PÁGINA RENDERIZA
    return parent::getPage('Cadastrar-se', $content, "", "");
  }

  /**
   * Método responsável por cadastrar um novo usuários no banco
   *
   * @param   Request  $request
   *
   * @return  string
   */
  public static function setNewUser(Request $request) {
    // POST VARS
    $postVars = $request->getPostVars();
    $nome     = (isset($postVars['nome']) and isset($postVars['sobrenome'])) ? "$postVars[nome] $postVars[sobrenome]" : '';
    $senha    = $postVars['senha'];
    $telefone = $postVars['telefone'] ?? '';
    $cpf      = $postVars['cpf'];
    $login    = $postVars['usuario'];
    $email    = $postVars['email'];

    // VALIDA O E-MAIL DO USUÁRIO
    $obUserLogin = EntityUser::getUserByLogin($login);
    if ($obUserLogin instanceof EntityUser) throw new \Exception('Login já existente', 409);

    // NOVA INSTÂNCIA DA ENTIDADE USUÁRIO
    $obUser = new EntityUser;
    $obUser->nome     = $nome;
    $obUser->senha    = $senha;
    $obUser->telefone = $telefone;
    $obUser->cpf      = $cpf;
    $obUser->login    = $login;
    $obUser->email    = $email;
    $obUser->insert();

    // LOGA O USUÁRIO
    SessionLogin::login($obUser);

    // REDIRECIONA O USUÁRIO
    $request->getRouter()->redirect('/usuario');
  }
};
