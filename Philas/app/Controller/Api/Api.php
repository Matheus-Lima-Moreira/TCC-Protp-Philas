<?php

namespace App\Controller\Api;

use App\Http\Request;
use App\Model\Entity\Us as EntityUs;
use App\Model\Entity\User as EntityUser;
use Firebase\JWT\JWT;
use WilliamCosta\DatabaseManager\Pagination;

class Api {

  /**
   * Método responsável por retornar os detalhes da API para
   *
   * @return  array  
   */
  public static function getDetails() {
    // BUSCA AS NOSSAS IRMOFAÇÕES
    $obUs = new EntityUs;

    // RETORNAR OS DAALHES DA API
    return [
      'nome'       => "API — $obUs->name",
      'versao'     => 'v1.0.0',
      'autores'    => $obUs->authors,
      'professoes' => [],
      'base'       => [
        'nome'     => 'William Costa',
        'GitHub'   => 'https://github.com/william-costa/william-costa',
        'refencia' => 'https://youtube.com/playlist?list=PL_zkXQGHYosGQwNkMMdhRZgm4GjspTnXs'
      ]
    ];
  }

  /**
   * Método responsável por retornar a paginação
   *
   * @param   Request     $request  
   * @param   Pagination  $obPagination
   *
   * @return  array             
   */
  protected static function getPagination(Request $request, Pagination $obPagination) {
    // QUERY PARAMS
    $queryParams = $request->getQueryParams();

    // PÁGINAS
    $pages = $obPagination->getPages();

    // RETORNA 
    return [
      'atual' => (int) ($queryParams['page'] ?? 1),
      'total' => !empty($pages) ? count($pages) : 1
    ];
  }

  /**
   * Método responsável por gerar e retornar um token JWT
   *
   * @param   Request  $request  
   *
   * @return  array             
   */
  public static function genarateToken(Request $request) {
    // POST VARS
    $postVars = $request->getPostVars();

    // VALIDA OS CAMPOS OBRIGÁTORIOS
    if (!isset($postVars['usuario']) || !isset($postVars['senha'])) throw new \Exception("Os campos 'usuario' e 'senha' são obrigatórios", 400);

    // BUSCA USUÁRIO PELO LOGIN
    $obUser = EntityUser::getUserByLogin($postVars['usuario']);

    // VALIDA O LOGIN
    if (!$obUser instanceof EntityUser) throw new \Exception("Usuário inválido", 401);

    // VALIDA A SENHA
    if (!password_verify($postVars['senha'], $obUser->senha)) throw new \Exception("Senha inválida", 401);

    // PAYLOAD
    $payload = [
      'id'       => $obUser->id,
      'nome'     => $obUser->nome,
      'login'    => $obUser->login,
      'email'    => $obUser->email,
      'telefone' => $obUser->telefone,
      'cpf'      => $obUser->cpf,
      'tipo'     => $obUser->tipo
    ];

    // RETORNA O TOKEN GERADO
    return [
      'token' => JWT::encode($payload, getenv('JWT_KEY'))
    ];
  }
}
