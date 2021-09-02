<?php

namespace App\Controller\User;

use \App\Http\Request;
use \App\Model\Entity\User as EntityUser;
use \App\Utils\View;

class MyAccount extends Page {

  public static function getMyAccount() {
    // VIEW DA MINHA CONTA
    $content =  View::render('user\\form', [
      'title_form' => '',
      'name'       => 'pirocao',
      'lastname'   => 'grande',
      'phone'      => 'grosso',
      'cpf'        => '123',
      'user'       => 'carlos',
      'email'      => 'penizao',
      'action'     => 'Alterar'
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('Minha Conta', $content);
  }
}
