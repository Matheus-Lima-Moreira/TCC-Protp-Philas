<?php

namespace App\Controller\Main;

use App\Utils\View;

class Home extends Page {

  /**
   * Método responsável por retornar o conteúdo (VIEW) da Home
   *
   * @return  string  
   */
  public static function getHome() {
    // VIEW DA HOME
    $content =  View::render('home');

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('{{us_name}}', $content);
  }
};
