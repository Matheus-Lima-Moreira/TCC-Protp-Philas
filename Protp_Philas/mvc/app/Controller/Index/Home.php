<?php

namespace App\Controller\Index;

use App\Model\Entity\Us as EntityUs;
use App\Utils\View;

class Home extends Page {

  /**
   * Método responsável por retornar o conteúdo (VIEW) da Home
   *
   * @return  string  
   */
  public static function getHome(): string {
    // INSTANCIA DA ENTIDADE CONTENT
    $obContent = (new EntityUs)->conteudo;
    
    // VIEW DA HOME
    $content =  View::render('home',[
      'titulo' => $obContent->titulo,
      'texto'  => $obContent->texto
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('{{us_name}}', $content);
  }
};
