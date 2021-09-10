<?php

namespace App\Controller\User;

use App\Http\Request;
use App\Model\Entity\User as EntityUser;
use App\Utils\View;

class MyAccount extends Page {

  public static function getMyAccount() {
    // USUÁRIO LOGADO
    $obUser =  $_SESSION['ph_login']['usuario'];
    
    // VIEW DA MINHA CONTA
    $content =  View::render('user/form', [
      'title_form' => '',
      'name'       => explode(' ', $obUser->nome, 2)[0],
      'lastname'   => explode(' ', $obUser->nome, 2)[1],
      'phone'      => $obUser->telefone,
      'cpf'        => $obUser->cpf,
      'user'       => $obUser->login,
      'email'      => $obUser->email,
      'action'     => 'Alterar'
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('Minha Conta', $content);
  }
}
