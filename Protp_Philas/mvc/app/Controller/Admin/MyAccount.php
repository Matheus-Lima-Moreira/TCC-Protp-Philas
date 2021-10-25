<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Model\Entity\User as EntityUser;
use App\Session\Login as SessionLogin;
use App\Utils\Alert;
use App\Utils\View;

class MyAccount extends Page {

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
      case 'usuarioAlterado':
        return Alert::getSuccess('Usuário alterado com sucesso!');
      case 'usuarioExistente':
        return Alert::getError('O usuário já está em uso!');
      case 'senhaAtualIncorreta':
        return Alert::getError('A senha atual está errada!');
      case 'senhaAlterada':
        return Alert::getSuccess('Senha alterada com sucesso!');
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
    $request->getRouter()->redirect('/admin/minhaConta?status=' . $status);
  }

  /**
   * Método responsável por renderizar o formulário de alteração do usuário atual
   *
   * @param   Request  $request
   * 
   * @return  string
   */
  public static function getMyAccount(Request $request): string {
    // USUÁRIO LOGADO
    $obUser = $_SESSION['ph_login']['usuario'];

    // NOME COMPLETO DO USUÁRIO REPARTIDO
    $fullname = explode(' ', $obUser->nome, 2);

    // VIEW DA MINHA CONTA
    $content = View::render('admin/formEdit', [
      'title_form' => '',
      'name'       => $fullname[0] ?? '',
      'lastname'   => $fullname[1] ?? '',
      'phone'      => $obUser->telefone,
      'cpf'        => $obUser->cpf,
      'user'       => $obUser->login,
      'email'      => $obUser->email,
      'status'     => self::getStatus($request),
      'action'     => 'Alterar'
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage(
      'Minha Conta',
      $content
    );
  }

  /**
   * Método responsável por alterar o usuário atual
   * 
   * @param   Request  $request
   * 
   */
  public static function setEditMyAccount(Request $request): void {
    // POST VARS
    $postVars = $request->getPostVars();
    $nome     = (isset($postVars['nome']) and isset($postVars['sobrenome'])) ? "$postVars[nome] $postVars[sobrenome]" : '';
    $telefone = $postVars['telefone'] ?? '';
    $cpf      = $postVars['cpf'];
    $login    = $postVars['usuario'];
    $email    = $postVars['email'];

    // VALIDA O LOGIN (DUPLICAÇÃO)
    $obUserLogin = EntityUser::getUserByLogin($postVars['usuario']);
    if ($obUserLogin instanceof EntityUser && $obUserLogin->id != $_SESSION['ph_login']['usuario']->id)
      self::returnStatus($request, 'usuarioExistente');

    // NOVA INSTÂNCIA DA ENTIDADE USUÁRIO
    $obUser           = new EntityUser;
    $obUser->id       = $_SESSION['ph_login']['usuario']->id;
    $obUser->nome     = $nome;
    $obUser->telefone = $telefone;
    $obUser->cpf      = $cpf;
    $obUser->login    = $login;
    $obUser->email    = $email;
    $obUser->tipo     = EntityUser::$tipos['admin'];
    $obUser->update();

    // LOGA O USUÁRIO
    SessionLogin::login($obUser);

    // REDIRECIONA O USUÁRIO
    self::returnStatus($request, 'usuarioAlterado');
  }

  /**
   * Método responsável por renderizar o formulário de alteração da senha
   *
   * @param   Request  $request
   *
   * @return  string
   */
  public static function getMyPassword(Request $request): string {
    // VIEW DA MINHA CONTA
    $content = View::render('admin/formEditPassword', [
      'title_form' => '',
      'status'     => self::getStatus($request),
      'action'     => 'Alterar'
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage(
      'Alterar Senha',
      $content
    );
  }

  /**
   * Método responsável por alterar a senha
   *
   * @param   Request  $request
   */
  public static function setMyPassword(Request $request): void {
    // POST VARS
    $postVars    = $request->getPostVars();
    $nova_senha  = $postVars['nova_senha'];
    $senha_atual = $postVars['senha_atual'];

    // VALIDA A SENHA (ATUAL)
    $obUserPassword = EntityUser::getUserById($_SESSION['ph_login']['usuario']->id);
    if (!password_verify($senha_atual, $obUserPassword->senha))
      $request->getRouter()->redirect('/admin/minhaConta/senha?status=senhaAtualIncorreta');

    // ATUALIZA SOMENTE A SENHA DO USUÁRIO
    $obUserPassword->senha = $nova_senha;
    $obUserPassword->update();

    // LOGA O USUÁRIO
    SessionLogin::login($obUserPassword);

    // REDIRECIONA O USUÁRIO
    $request->getRouter()->redirect('/admin/minhaConta/senha?status=senhaAlterada');
  }
}
