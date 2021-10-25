<?php

namespace App\Controller\Index;

use App\Model\Entity\Us as EntityUs;
use App\Utils\View;

// REMINDER: Terminar as nossas paginas
class Us extends Page {

  /**
   * Método responsável por renderizar os contedúdos da organazação
   *
   * @param   string  $title
   * @param   string  $content
   *
   * @return  string
   */
  private static function renderPage(string $title, string $content): string {
    // FOOTER
    $footer = View::render('us/footer');

    // HEADER
    $header = View::render('header');

    // RENDERIZADA O DEFAULT
    return parent::getPage($title, $content, $header, $footer);
  }

  /**
   * Método responsável por renderizar o painel de sobre
   *
   * @param   string  $title
   * @param   string  $content
   * @param   string  $page
   *
   * @return  string
   */
  private static function getAboutPanel(string $title, string $content, string $page): string {
    /** Método responsável por retornar a paginação */
    function getAboutPagination(string $currentPage): string {
      // PÁGINAS
      $links = '';

      // PÁGINAS DO PAINEL
      $pages = ['' => 'Nós'];

      // ADICIONA OS AUTORES ÀS PÁGINAS DO PAINEL
      foreach ((new EntityUs)->autores as $hash => $author) {
        $pages += [$hash => explode(' ', $author->nome, 2)[0]];
      }

      // RENDERIZA OS LINKS PARA AS PÁGINAS
      foreach ($pages as $hash => $page) {
        $links .= View::render('Pagination/link', [
          'link'   => URL . '/sobre' . '/' . $hash,
          'active' => $currentPage == $hash ? 'active' : '',
          'page'   => $page
        ]);
      }

      // RETORNA A PAGINAÇÃO
      return View::render('Pagination/box', [
        'links' => $links
      ]);
    }

    // VIEW DO PAINEL SOBRE
    $content = View::render('us/about', [
      'title'      => $title,
      'content'    => $content,
      'pagination' => getAboutPagination($page)
    ]);

    // RETORNA A VIEW DO PAINEL
    return self::renderPage('Sobre', $content);
  }

  /**
   * Método responsável por retornar o conteúdo (VIEW) do Sobre Nós
   *
   * @return  string
   */
  public static function getAbout(): string {
    // VIEW DA TELA SOBRE NÓS
    $content = View::render('us/about/index', [
      'text' => 'Objetivando uma modelar assessoria, em respeito a Secretaria Institucional do Philadelpho, propomos a concepção de um arranjo virtual para estipulação de serviços em geral. Um Website que visa facilitar os agendamentos à Secretaria, baseado nos sistemas de spiders, agendamento e filas.'
    ]);

    // RETORNA A VIEW DA PÁGINA
    return self::getAboutPanel('{{us_name}}', $content, '');
  }

  /**
   * Método responsável por retornar o conteúdo (VIEW) dos autores
   *
   * @param   string  $author
   *
   * @return  string
   */
  public static function getAuthors(string $author): string {
    // INSTANCIA DA ENTIDADE NÓS E OBTENÇÃO DOS AUTORES
    $obAuthors = (new EntityUs)->autores;

    // VALIDA O CRIADOR
    if (!array_key_exists($author, $obAuthors))
      throw new \Exception('Autor inválido. Existentes: [' . implode(', ', array_keys($obAuthors)) . ']', 404);

    // VIEW DA TELA SOBRE AUTOR
    $content = View::render('us/about/authors', [
      'text'  => $obAuthors[$author]->descricao,
      'image' => $obAuthors[$author]->imagem ?: 'Files/default.jpg',
    ]);

    // RETORNA A VIEW DA PÁGINA
    return self::getAboutPanel($obAuthors[$author]->nome, $content, $author);
  }

  /**
   * Método responsável por retornar o conteúdo (VIEW) da Privacidade
   *
   * @return  string
   */
  public static function getPrivacy(): string {
    // VIEW DA TELA PRIVACIDADE
    $content = View::render('us/privacy');

    // RETORNA A VIEW DA PÁGINA
    return self::renderPage('Privacidade', $content);
  }

  /**
   * Método responsável por retornar o conteúdo (VIEW) do SiteMap
   *
   * @return  string
   */
  public static function getMap(): string {
    // VIEW DA TELA PRIVACIDADE
    $content = View::render('us/sitemap');

    // RETORNA A VIEW DA PÁGINA
    return self::renderPage('Termos', $content);
  }
};
