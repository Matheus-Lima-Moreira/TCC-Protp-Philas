<?php

namespace App\Controller\User;

use App\Http\Request;
use App\Model\Entity\User as EntityUser;
use App\Session\Login as SessionLogin;
use App\Utils\Alert;
use App\Utils\CPF;
use App\Utils\Masker;
use App\Utils\View;

class Main extends Page {

  /**
   * Método responsável por retornar a mensagem de status
   *
   * @param   Request  $request  
   *
   * @return  string             
   */
  private static function getStatus(Request $request): string {
    // QUERY PARAMS
    $queryParams = $request->getQueryParams();

    // STATUS
    if (!isset($queryParams['status'])) return '';

    // MENSAGEM DE STATUS
    switch ($queryParams['status']) {
      case 'usuarioExistente':
        return Alert::getError('O usuário já está em uso!');
      case 'cpfInvalido':
        return Alert::getError('O CPF é inválido!');
      default:
        return '';
    }
  }

  /**
   * Método responsável por redirecionar o usuário com um status
   *
   * @param   Request  $request
   * @param   string   $status
   *
   * @return  void
   */
  private static function returnStatus(Request $request, string $status): void {
    $request->getRouter()->redirect('/singup?status=' . $status);
  }

  /**
   * Método responsável por retornar o conteúdo (VIEW) da Home
   *
   * @return  string  
   */
  public static function getHome(): string {
    // VIEW DA HOME
    $content =  View::render('user/home');

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('Início', $content);
  }

  /**
   * Método responsável por retornar o formuário de cadastro
   *
   * @param   Request  $request
   *
   * @return  string            
   */
  public static function getNewUser(Request $request): string {
    // CONTEÚDO DO FORMULÁRIO
    $content = View::render('user/formNew', [
      'title_form' => 'Preencha com seus dados',
      'status'     => self::getStatus($request),
      'name'       => '',
      'lastname'   => '',
      'phone'      => '',
      'cpf'        => '',
      'user'       => '',
      'email'      => ''
    ]);

    // RETORNAR A PÁGINA RENDERIZA
    return parent::getPage(
      'Cadastrar-se',
      $content,
      '',
      '',
    );
  }

  /**
   * Método responsável por cadastrar um novo usuários no banco
   *
   * @param   Request  $request
   *
   * @return  string
   */
  public static function setNewUser(Request $request): string {
    // POST VARS
    $postVars = $request->getPostVars();
    $nome     = (isset($postVars['nome']) and isset($postVars['sobrenome'])) ? "$postVars[nome] $postVars[sobrenome]" : '';
    $senha    = $postVars['senha'];
    $telefone = $postVars['telefone'] ?? '';
    $cpf      = Masker::remove($postVars['cpf']);
    $login    = $postVars['usuario'];
    $email    = $postVars['email'];

    // VALIDA O LOGIN DO USUÁRIO
    $obUserLogin = EntityUser::getUserByLogin($login);
    if ($obUserLogin instanceof EntityUser) self::returnStatus($request, 'usuarioExistente');

    // VALIDA O CPF
    if (!CPF::isvalid($cpf)) self::returnStatus($request, 'cpfInvalido');

    // NOVA INSTÂNCIA DA ENTIDADE USUÁRIO
    $obUser           = new EntityUser;
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
