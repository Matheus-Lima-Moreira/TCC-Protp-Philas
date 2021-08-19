<?php

require_once(__DIR__ . "\\usuario\\Usuario.php");
require_once(__DIR__ . "\\Conexao.php");
// require_once("connection.php");

$login_file = __DIR__ . "\\logins_lembrar\\?.json";

// echo ((new Login)->logar(new class extends Usuario {
//   public $login = "Luis";
//   public $email = "email";
//   public $senha = "1234";
// }, true))?:0;

// echo ((new Login)->estaLogado()) ?: 0;

// (new Login)->deslogar();


class Login {
  public function __construct() {
    session_start();
  }

  public function logar(Usuario $Usuario, Bool $lembrar = false) {
    // global $conn;

    $sql = "SELECT `id`, `nome`, `tipo`
    FROM `tb_usuario` 
    WHERE (`login` = '$Usuario->login' OR `email` = '$Usuario->email') AND `senha` = '$Usuario->senha'";

    if ($usuario_r = mysqli_fetch_assoc((new Conexao())->consulta($sql))) {
      if ($lembrar) {
        // TODO: add token la ou nn fds >:(
        global $login_file;

        do {
          $login_code = random_int(0, PHP_INT_MAX);
          $file = str_replace("?", $login_code, $login_file);
        } while (file_exists($file));

        file_put_contents($file, json_encode($usuario_r));

        setcookie("login", $login_code, time() + 86400 * 365, "/");
      }

      $this->sessao($usuario_r);

      return true;
    } else {
      return false;
    }
  }

  public function deslogar() {
    session_destroy(); // se for usar session pra outra coisa, mudar isso aqui
    setcookie("PHPSESSID", "", 1, "/"); //

    setcookie("login", "", 1, "/");
  }


  public function estaLogado() {
    if (isset($_SESSION["logado"])) return true;

    if (isset($_COOKIE["login"])) {
      global $login_file;

      $file = str_replace("?", $_COOKIE["login"], $login_file);

      if (!file_exists($file)) return false;

      $usuario_r = json_decode(file_get_contents($file));

      setcookie("login", $_COOKIE["login"], time() + 86400 * 365, "/");

      $this->sessao($usuario_r);

      return true;
    }

    return false;
  }

  private function sessao($usuario_r) {
    $_SESSION["logado"] = true; // só pra controle

    foreach ($usuario_r as $key => $value) {
      $_SESSION["$key"] = $value;
    }
  }
}
