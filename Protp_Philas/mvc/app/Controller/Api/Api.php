<?php

namespace App\Controller\Api;

use \App\Http\Request;
use \App\Model\Entity\Us as EntityUs;
use \WilliamCosta\DatabaseManager\Pagination;

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
}
