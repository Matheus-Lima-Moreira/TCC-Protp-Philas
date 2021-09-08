<?php

namespace App\Controller\Api;

use \App\Http\Request;
use \App\Model\Entity\User as EntityUser;
use App\Utils\CPF;
use App\Utils\Masker;
use \WilliamCosta\DatabaseManager\Pagination;

class User extends Api {

  /**
   * Método responsável por renderizar e retornar os dados do usuário
   *
   * @param   EntityUser  $obUser
   *
   * @return  array
   */
  private static function getUserData(EntityUser $obUser): array {
    // RETIRA A SENHA DO RETORNO
    unset($obUser->senha);

    // CAST NOS VALORES NUMÉRICOS
    foreach ($obUser as $prop => &$value) {
      // IGNORA O CPF
      if (strtoupper($prop) == "CPF") continue;

      $value = is_numeric($value) ? (float) $value : $value;
    }

    // RETORNA A ENTIDADE USUÁRIO RENDERIZADA
    return (array) $obUser;
  }

  /**
   * Método responsável por cadastrar e retornar os dados do usuário
   *
   * @param   array  $userData
   *
   * @return  EntityUser
   */
  private static function setUserData(array $userData): EntityUser {
    // INSTANCIA A ENTIDADE USUÁRIO
    $obUser = new EntityUser;

    // RETIRA O ID DO LOOP
    unset($obUser->id);

    // CADASTRA OS DADOS
    foreach ($obUser as $prop => &$value) {
      // RETIRA A MASCÁRA DO CPF
      if (strtoupper($prop) == "CPF") {
        $value = Masker::remove($userData[$prop]);
      }

      // IGNORA OS NULOS
      if (!isset($userData[$prop]) or empty($userData[$prop])) continue;

      // SETA OS VALORES
      $value = $userData[$prop];
    }

    // RETORNA OS DADOS
    return $obUser;
  }

  /**
   * Método responsável por retornar os itens de Usuários para a API
   *
   * @param   Request      $request       
   * @param   Pagination   $obPagination  
   *
   * @return  array
   */
  private static function getUsersItems(Request $request, ?Pagination &$obPagination) {
    // USUÁRIOS
    $itens = [];

    // QUANTIDADE TOTAL DE REGISTRO
    $quantidadeTotal = EntityUser::getUsers(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

    // PÁGINA ATUAL
    $queryParams = $request->getQueryParams();
    $paginaAtual = $queryParams['page'] ?? 1;

    // LIMITE POR PÁGINA
    $limit = $queryParams['per_page'] ?? 3;
    $limit = is_numeric($limit) ? $limit : 3;

    // VALIDANDO SE DEVE MOSTRAS TODOS OS REGISTROS
    $limit = $limit > 0 ? $limit : $quantidadeTotal;

    // INSTÂNCIA DE PAGINAÇÃO
    $obPagination = new Pagination($quantidadeTotal, $paginaAtual, $limit);

    // RESULTADOS DA PÁGINA
    $results = EntityUser::getUsers(null, 'id ASC', $obPagination->getLimit());

    // RENDERIZA O(S) ITEM(S)
    while ($obUser = $results->fetchObject(EntityUser::class)) {
      $itens[] = self::getUserData($obUser);
    }

    // RETORNA O(S) USUÁRIO(S)
    return $itens;
  }

  /**
   * Método responsável por retonar os usuarios cadastrados
   *
   * @param   Request  $request
   *
   * @return  array
   */
  public static function getUsers(Request $request): array {
    return [
      'usuarios'  => self::getUsersItems($request, $obPagination),
      'paginacao' => parent::getPagination($request, $obPagination)
    ];
  }

  /**
   * Método responsável por retornar um usuário específico
   *
   * @param   integer   $id
   *
   * @return  array
   */
  public static function getUser($id): array {
    // VÁLIDA O PARÂMETRO ID
    if (!is_numeric($id)) throw new \Exception('ID "' . $id . '" inválido', 400);

    // BUSCA PELO USUÁRIO
    $obUser = EntityUser::getUserById($id);

    // VALIDA SE O USUÁRIO EXISTE
    if (!$obUser instanceof EntityUser) throw new \Exception("Usuário($id) não encontrado", 404);

    // RETORNA OS DADOS DO USUÁRIO
    return self::getUserData($obUser);
  }

  /**
   * Método responsável por retornar o usuário atual
   *
   * @param   Request  $request
   *
   * @return  array
   */
  public static function getCurrentUser(Request $request): array {
    // RETORNA OS DADOS DO USUÁRIO ATUAL
    return self::getUserData($request->userLogged);
  }

  /**
   * Método responsável por validar os campos
   *
   * @param   array  $postVars
   *
   * @return  void
   */
  private static function validateFields(array $postVars): void {
    // VALIDA OS CAMPOS OBRIGÁTORIOS
    if (
      !isset($postVars['login']) ||
      !isset($postVars['senha']) ||
      !isset($postVars['cpf'])
    ) throw new \Exception("Os campos 'login', 'senha' e 'cpf' são obrigatórios", 400);

    // VALIDA O CPF
    if (!CPF::isvalid(Masker::remove($postVars['cpf'])))
      throw new \Exception("CPF '$postVars[cpf]' inválido", 400);
  }

  /**
   * Método responsável por cadastrar um novo usuário
   *
   * @param   Request  $request
   *
   * @return  array
   */
  public static function setNewUser(Request $request): array {
    // POST VARS
    $postVars = $request->getPostVars();

    // VALIDA OS CAMPOS
    self::validateFields($postVars);

    // VALIDA O LOGIN (DUPLICAÇÃO)
    if (EntityUser::getUserByLogin($postVars['login']) instanceof EntityUser)
      throw new \Exception("O login '$postVars[login]' já está em uso", 409); #422 303

    // DEFINE O TIPO DO USUÁRIO PARA PADRÃO
    $postVars['tipo'] = null;

    // CADASTRA O NOVO USUÁRIO
    $obUser = self::setUserData($postVars);
    $obUser->insert();

    // RETORNA OS DETALHES DO USUÁRIO CADASTRADO
    return self::getUserData($obUser);
  }

  /**
   * Método responsável por atualizar o usuário atual
   *
   * @param   Request  $request
   *
   * @return  array
   */
  public static function setEditCurrentUser(Request $request): array {
    // POST VARS
    $postVars = $request->getPostVars();

    // VALIDA OS CAMPOS
    self::validateFields($postVars);

    // VALIDA O LOGIN (DUPLICAÇÃO)
    $obUserLogin = EntityUser::getUserByLogin($postVars['login']);
    if ($obUserLogin instanceof EntityUser && $obUserLogin->id != $request->userLogged->id)
      throw new \Exception("O login '$postVars[login]' já está em uso", 409); #422 303

    // DEFINE O TIPO DO USUÁRIO PARA PADRÃO
    $postVars['tipo'] = null;

    // ATUALIZA O NOVO USUÁRIO
    $obUser = self::setUserData($postVars);
    $obUser->id = $request->userLogged->id;
    $obUser->update();

    // RETORNA OS DETALHES DO USUÁRIO ATUALIZADO
    return self::getUserData($obUser);
  }
}
