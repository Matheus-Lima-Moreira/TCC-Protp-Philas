<?php

require_once(__DIR__."\\..\\Conexao.php");

// $U = new Usuario();
// $U->criar($U);

class Usuario {
  public $nome;
  public $telefone;
  public $cpf;
  public $login;
  public $senha;
  public $email;
  public $tipo;

  public function criar(Usuario $Usuario) {
    // (new Conexao())->conectar($conn);

    $sql = "INSERT INTO `tb_usuario`
    (`nome`, `telefone`, `cpf`, `login`, `senha`, `email`, `tipo`)
    VALUES
    (
      '$Usuario->nome',
      '$Usuario->telefone',
      '$Usuario->cpf',
      '$Usuario->login',
      '$Usuario->senha',
      '$Usuario->email',
      '$Usuario->tipo'
    )";

    /*
      $sql = mysqli_real_escape_string($conn, $sql);
  
      mysqli_query($conn, $sql);

      mysqli_close($conn);
    */

    (new Conexao())->consulta($sql);
  }

  public function ler() {
    // TODO: lol
  }

  public function atualizar() {
    // TODO: lol 
  }

  public function deletar() {
    // TODO: lol
  }
}
