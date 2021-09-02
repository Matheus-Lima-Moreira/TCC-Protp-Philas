<?php

namespace App\Controller\Main;

use \App\Http\Request;
use \App\Model\Entity\Us;
use \App\Utils\View;

class Page {

  /**
   * Método responsável por renderizar o topo da página
   *
   * @return  string
   */
  private static function getHeader() {
    return View::render('header');
  }

  /**
   * Método responsável por renderizar o rodapé da página
   *
   * @return  string
   */
  private static function getFooter() {
    return View::render('footer');
  }

  /**
   * Método responsável por renderizar o layout de paginação
   *
   * @param   Request     $request
   * @param   Pagination  $obgPagination
   *
   * @return  string
   */
  public static function getPagination(Request $request, $obgPagination) {
    // PÁGINAS
    $pages = $obgPagination->getPages();

    // VERIFICA A QUANTIDADE DE PÁGINAS
    if (count($pages) <= 1) return '';

    // LINKS
    $links = '';

    // URL ATUAL (SEM QUERYS)
    $url =  $request->getRouter()->getCurrentUrl();

    // QUERY
    $queryParams = $request->getQueryParams();

    // RENDERIZA OS LINKS
    foreach ($pages as $page) {
      // ALTERA PÁGINA
      $queryParams['page'] = $page['page'];

      // LINK
      $link = $url . '?' . http_build_query($queryParams);

      // VIEW
      $links .= View::render('\\pages\\pagination\\link', [
        'page'   => $page['page'],
        'link'   => $link,
        'active' => $page['current'] ? 'active' : ''
      ]);
    }

    // RENDERIZA BOX DE PAGINAÇÃO
    return  View::render('\\pages\\pagination\\box', [
      'links' => $links
    ]);
  }

  /**
   * Método responsável por retornar o conteúdo (view) da página genárica
   *
   * @param   string  $title
   * @param   string  $content
   * @param   string  $header
   * @param   string  $footer
   *
   * @return  string
   */
  public static function getPage(string $title, string $content, ?string $header = null, ?string $footer = null) {
    // INSTÂNCIA DA ENTIDADE 'US'
    $obUs = new Us;

    // RENDERIZA A PÁGINA GENÉRICA
    return View::render('page', [
      'title'      => $title,
      'header'     => $header ?? self::getHeader(),
      'content'    => $content,
      'footer'     => $footer ?? self::getFooter(),
      'us_name'    => $obUs->name
    ]);
  }
};
