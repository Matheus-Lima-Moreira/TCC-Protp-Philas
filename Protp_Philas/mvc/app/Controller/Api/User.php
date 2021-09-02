<?php

namespace App\Controller\Api;

use \App\Http\Request;
use \App\Model\Entity\User as EntityUser;
use \WilliamCosta\DatabaseManager\Pagination;

class User extends Api {

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
    while ($obUsuer = $results->fetchObject(EntityUser::class)) {
      $itens[] = [
        'id'       => (int) $obUsuer->id,
        'nome'     => $obUsuer->nome,
        'telefone' => (int) $obUsuer->telefone,
        'cpf'      => (int) $obUsuer->cpf,
        'login'    => $obUsuer->login,
        'email'    => $obUsuer->email,
        'tipo'     => $obUsuer->tipo
      ];
    }

    // RETORNA O(S) USUÁRIO(S)
    return $itens;
  }

  public static function getUsers(Request $request) {
    return [
      'usuarios'  => self::getUsersItems($request, $obPagination),
      'paginacao' => parent::getPagination($request, $obPagination)
    ];
  }
}
