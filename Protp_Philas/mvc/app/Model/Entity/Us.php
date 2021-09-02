<?php

namespace App\Model\Entity;

class Us {

  /** @var string $name Nome da nossa organazação */
  public $name = 'Protótipo Philas';

  /** @var array $authors Nossos nomes e contatos */
  public $authors = [
    'Laiany'  => [
      'email' => '',
      'usuario' => '',
    ],
    'Luis'    => [
      'email' => 'luisguerra2004@gmail.com',
      'usuario' => '',
    ],
    'Matheus' => [
      'email' => '',
      'usuario' => ''
    ]
  ];

  /** @var string $descripton Descrição da organização */
  public $descripton = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis in dolor error excepturi cumque repellat, tenetur praesentium sed, ad velit repudiandae alias fuga culpa debitis veritatis corporis, pariatur possimus. Neque.';
}
